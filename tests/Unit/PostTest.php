<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
// use App\Post;

class PostTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    // use RefreshDatabase;

    public function testExample()
    {
        // $this->assertTrue(true);
        factory(Post::class, 5)->create();
 
        // 取得所有資料
        $posts = Post::all();
 
        // 斷言結果
        $this->assertCount(5, $posts);
    }
}
