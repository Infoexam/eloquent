<?php

use Carbon\Carbon;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\DB;
use Infoexam\Eloquent\Models\Category;
use Infoexam\Eloquent\Models\Exam;
use Infoexam\Eloquent\Models\Listing;
use Infoexam\Eloquent\Models\News;
use Infoexam\Eloquent\Models\Option;
use Infoexam\Eloquent\Models\Paper;
use Infoexam\Eloquent\Models\Question;
use Infoexam\Eloquent\Models\Receipt;
use Infoexam\Eloquent\Models\User;
use Orchestra\Testbench\TestCase;

class EloquentTest extends TestCase
{
    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->loadMigrationsFrom(__DIR__ . '/migrations');
    }

    /**
     * Get package providers.
     *
     * @param Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app): array
    {
        return [
            Infoexam\Eloquent\EloquentServiceProvider::class,
        ];
    }

    public function test_empty_string_to_null()
    {
        $user = User::query()->create(['name' => 'apple'])->fresh();

        $this->assertSame('apple', $user->getAttribute('name'));

        $user->update(['name' => '']);

        $this->assertNull($user->getAttribute('name'));
    }

    public function test_sensitivities()
    {
        $exam = Exam::query()->create(['name' => 'th#is is     an apple'])->fresh();

        $this->assertSame('th-is-is-an-apple', $exam->getAttribute('name'));

        $exam->update(['name' => ' apple   is good  ']);

        $this->assertSame('apple-is-good', $exam->getAttribute('name'));
    }

    public function test_user_own()
    {
        $user = User::query()->create()->fresh();

        $this->assertTrue($user->own('testing'));

        $this->assertTrue($user->own(['apple', 'banana', 'testing']));

        $this->assertFalse($user->own('banana'));

        $this->assertFalse($user->own(['apple', 'banana', 'car']));

        $user->delete();

        $this->assertFalse($user->own('testing'));
    }

    public function test_user_password()
    {
        $user = User::query()->create(['password' => 'apple'])->fresh();

        $attributes = $user->getAttributes();

        $this->assertNotSame('apple', $attributes['password']);

        $this->assertSame('apple', $user->getAttribute('password'));
    }

    public function test_receipt_created_at()
    {
        $user = User::query()->create();

        $receipt = $user->receipts()->save(new Receipt);

        $this->assertInstanceOf(Carbon::class, $receipt->getAttribute('created_at'));
    }

    public function test_exam_and_question_deleting()
    {
        $exam = Exam::query()->create();

        $questions = $exam->questions()->saveMany([new Question, new Question]);

        foreach ($questions as $question) {
            /* @var Question $question */
            $question->options()->saveMany([new Option, new Option]);
        }

        $question->questions()->save(new Question(['exam_id' => $exam->getKey()]));

        $this->assertCount(3, Question::all());

        $exam->delete();

        $this->assertCount(0, Option::all());
        $this->assertCount(0, Question::all());
        $this->assertCount(0, Exam::all());
    }

    public function test_paper_deleting()
    {
        $questions = Exam::query()->create()
            ->questions()
            ->saveMany([new Question, new Question]);

        $paper = Paper::query()->create();

        $paper->questions()->saveMany($questions);

        $this->assertCount(2, DB::table('paper_question')->get());

        $paper->delete();

        $this->assertCount(0, DB::table('paper_question')->get());
    }

    public function test_listing_saving()
    {
        $now = Carbon::parse('2016-12-31 00:00:00');

        $listing = Listing::query()->create([
            'began_at' => $now,
            'duration' => 50,
            'room' => 123,
        ]);

        $this->assertSame('201612310000123', $listing->getAttribute('code'));
        $this->assertSame('2016-12-31 00:50:00', $listing->getAttribute('ended_at')->toDateTimeString());

        $listing = Listing::query()->create([
            'began_at' => $now,
            'started_at' => $now->copy()->addHour(),
            'duration' => 30,
            'room' => 123,
        ]);

        $this->assertSame('2016-12-31 01:30:00', $listing->getAttribute('ended_at')->toDateTimeString());
    }

    public function test_news_url_attribute()
    {
        $news = News::query()->create(['heading' => 'apple', 'content' => 'text']);

        $this->assertArrayHasKey('url', $news->toArray());
    }

    public function test_get_categories()
    {
        $category = Category::query()->create(['category' => 'fruit', 'name' => 'apple'])->fresh();
        Category::query()->create(['category' => 'fruit', 'name' => 'banana']);
        Category::query()->create(['category' => 'company', 'name' => 'google']);

        $this->assertCount(3, Category::getCategories());
        $this->assertCount(2, Category::getCategories('fruit'));
        $this->assertNull(Category::getCategories('people', 'hi'));
        $this->assertSame($category->getKey(), Category::getCategories('fruit', 'apple'));
        $this->assertEquals($category, Category::getCategories('fruit', 'apple', false));
    }
}
