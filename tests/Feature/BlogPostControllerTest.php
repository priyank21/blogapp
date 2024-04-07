<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\BlogPost;

class BlogPostControllerTest extends TestCase
{
    use RefreshDatabase;


    /**
     * Test displaying a listing of blog posts.
     */
    public function test_displaying_listing_of_blog_posts()
    {
        $user = User::factory()->create();
        $blogPosts = BlogPost::factory(3)->create();

        $response = $this->actingAs($user)->get(route('blog-posts.index'));

        $response->assertStatus(200);
        foreach ($blogPosts as $post) {
            $response->assertSee($post->title);
            $response->assertSee($post->content);
        }
    }

    /**
     * Test showing the form for creating a new blog post.
     */
    public function test_showing_create_blog_post_form()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('blog-posts.create'));

        $response->assertStatus(200);
    }

    /**
     * Test storing a newly created blog post.
     */
    public function test_storing_new_blog_post()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $newTitle = 'New Blog Post';
        $newContent = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.';

        $response = $this->post(route('blog-posts.store'), [
            'title' => $newTitle,
            'content' => $newContent,
        ]);

        $response->assertRedirect(route('blog-posts.index'));
        $this->assertDatabaseHas('blog_posts', [
            'title' => $newTitle,
            'content' => $newContent,
            'user_id' => $user->id,
        ]);
    }

    /**
     * Test showing a single blog post.
     */
    public function test_showing_single_blog_post()
    {
        $user = User::factory()->create();
        $blogPost = BlogPost::factory()->create();

        $response = $this->actingAs($user)->get(route('blog-posts.show', $blogPost->id));

        $response->assertStatus(200);
        $response->assertSee($blogPost->title);
        $response->assertSee($blogPost->content);
    }

    /**
     * Test showing the form for editing a blog post.
     */
    public function test_showing_edit_blog_post_form()
    {
        $user = User::factory()->create();
        $blogPost = BlogPost::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->get(route('blog-posts.edit', $blogPost->id));

        $response->assertStatus(200);
        $response->assertSee($blogPost->title);
        $response->assertSee($blogPost->content);
    }

    /**
     * Test updating a blog post.
     */
    public function test_updating_blog_post()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $blogPost = BlogPost::factory()->create(['user_id' => $user->id]);
        $newTitle = 'Updated Title';
        $newContent = 'Updated Content';

        $response = $this->put(route('blog-posts.update', $blogPost->id), [
            'title' => $newTitle,
            'content' => $newContent,
        ]);

        $response->assertRedirect(route('blog-posts.index'));
        $this->assertDatabaseHas('blog_posts', [
            'id' => $blogPost->id,
            'title' => $newTitle,
            'content' => $newContent,
        ]);
    }

    /**
     * Test removing a blog post.
     */
    public function test_removing_blog_post()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $blogPost = BlogPost::factory()->create(['user_id' => $user->id]);

        $response = $this->delete(route('blog-posts.destroy', $blogPost->id));

        $response->assertRedirect(route('blog-posts.index'));
        $this->assertDatabaseMissing('blog_posts', ['id' => $blogPost->id]);
    }
}
