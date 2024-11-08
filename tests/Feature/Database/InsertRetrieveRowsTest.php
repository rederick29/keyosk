<?php

namespace Tests\Feature\Database;

use App\Models\Cart;
use App\Models\Image;
use App\Models\Order;
use App\Models\Order\OrderStatus;
use App\Models\Product;
use App\Models\Review;
use App\Models\Tag;
use App\Models\Tag\AttributeTag;
use App\Models\Tag\ColourTag;
use App\Models\Tag\CompatibilityTag;
use App\Models\Tag\TagType;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Attributes\Depends;
use Tests\TestCase;

class InsertRetrieveRowsTest extends TestCase
{
    use RefreshDatabase;

    static private string $userName = 'Erick';
    static private string $userEmail = 'rederick29@example.com';
    static private string $userPassword = 'writingTests';

    static private string $productName = 'New Keyboard 2 Mini';
    static private string $productDescription = 'This is the new version of the Keyboard 2 Mini by Company';
    static private int $productStock = 5;
    static private float $productPrice = 39.99;

    private User|null $testUser;
    private Product|null $testProduct;

    public function setUp(): void
    {
        parent::setUp();

        $this->testUser = User::factory()->create([
            'name' => self::$userName,
            'email' => self::$userEmail,
            'password' => Hash::make(self::$userPassword),
        ]);

        $this->testProduct = Product::factory()->create([
            'name' => self::$productName,
            'description' => self::$productDescription,
            'stock' => self::$productStock,
            'price' => self::$productPrice,
        ]);
    }

    public function tearDown(): void
    {
        parent::tearDown();

        $this->testUser = null;
        $this->testProduct = null;
    }

    public function test_users()
    {
        $newUser = User::find($this->testUser->id);
        $this->assertNotNull($newUser);
        $this->assertEquals(self::$userName, $newUser->name);
        $this->assertEquals(self::$userEmail, $newUser->email);
        $this->assertTrue(Hash::check(self::$userPassword, $newUser->password));
    }

    #[Depends('test_users')] public function test_products()
    {

        $newProduct = Product::find($this->testProduct->id);
        $this->assertNotNull($newProduct);
        $this->assertEquals(self::$productName, $newProduct->name);
        $this->assertEquals(self::$productDescription, $newProduct->description);
        $this->assertEquals(self::$productStock, $newProduct->stock);
        $this->assertEquals(self::$productPrice, $newProduct->price);

        $this->testProduct = $newProduct;
    }

    #[Depends('test_products')] public function test_orders()
    {
        $status = OrderStatus::Processing;

        $order = Order::factory()
            ->for($this->testUser)
            ->forProducts(Collection::make([$this->testProduct]))
            ->create([
                'status' => $status,
            ]);

        $newOrder = Order::find($order->id);
        $this->assertNotNull($newOrder);
        $this->assertEquals($status, $newOrder->status);
        $this->assertEquals($this->testUser->id, $newOrder->user->id);
        $this->assertEquals($this->testProduct->id, $newOrder->products->first()->id);
        $this->assertEquals($this->testProduct->price, $newOrder->total_price);
    }

    #[Depends('test_products')] public function test_reviews()
    {
        $rating = 7;
        $subject = 'Broke after a year';
        $comment = 'the product worked fine at first but it broke after a while';

        $review = Review::factory()
            ->for($this->testProduct)
            ->for($this->testUser)
            ->create([
                'rating' => $rating,
                'subject' => $subject,
                'comment' => $comment,
            ]);

        $newReview = Review::find($review->id);
        $this->assertNotNull($newReview);
        $this->assertEquals($rating, $newReview->rating);
        $this->assertEquals($subject, $newReview->subject);
        $this->assertEquals($comment, $newReview->comment);
        $this->assertEquals($this->testProduct->id, $newReview->product->id);
        $this->assertEquals($this->testUser->id, $newReview->user->id);
    }

    #[Depends('test_products')] public function test_images()
    {
        $priority = 0;
        $location = 'resources/img/apple.png';

        $image = Image::factory()
            ->for($this->testProduct)
            ->create([
               'location' => $location,
               'priority' => $priority,
            ]);

        $newImage = Image::find($image->id);
        $this->assertNotNull($newImage);
        $this->assertEquals($priority, $newImage->priority);
        $this->assertEquals($location, $newImage->location);
        $this->assertEquals($this->testProduct->id, $newImage->product->id);
    }

    #[Depends('test_products')] public function test_carts()
    {
        $cart = Cart::factory()
            ->for($this->testUser)
            ->forProducts(Collection::make([$this->testProduct]))
            ->create();

        $newCart = Cart::find($cart->id);
        $this->assertNotNull($newCart);
        $this->assertEquals($this->testUser->id, $newCart->user->id);
        $this->assertEquals($this->testProduct->id, $newCart->products->first()->id);
    }

    #[Depends('test_products')] public function test_tags()
    {
        $hex_code = '#abcdef';
        $attributeDescription = 'new attribute description';
        $compatibilityDescription = 'incompatible with usb type-c';

        $colourTag = ColourTag::factory()
            ->for(Tag::factory()->state(['name' => 'Fun Colour', 'type' => TagType::Colour]))
            ->create(['hex_code' => $hex_code]);
        $attributeTag = AttributeTag::factory()
            ->for(Tag::factory()->state(['name' => 'Fun Attribute', 'type' => TagType::Attribute]))
            ->create(['description' => $attributeDescription]);
        $compatibilityTag = CompatibilityTag::factory()
            ->for(Tag::factory()->state(['name' => 'USB Type-C Compatibility', 'type' => TagType::Compatibility]))
            ->create(['description' => $compatibilityDescription]);

        $this->testProduct->tags()->attach($attributeTag->tag->id);
        $this->testProduct->tags()->attach($colourTag->tag->id);
        $this->testProduct->tags()->attach($compatibilityTag->tag->id);

        $this->assertEquals($this->testProduct->tags()->count(), 3);
        $this->assertEquals($this->testProduct->tags()->find($colourTag->tag->id)->type, TagType::Colour);
        $this->assertEquals($this->testProduct->tags()->find($colourTag->tag->id)->colourTag->hex_code, $hex_code);
        $this->assertEquals($this->testProduct->tags()->find($attributeTag->tag->id)->type, TagType::Attribute);
        $this->assertEquals($this->testProduct->tags()->find($attributeTag->tag->id)->attributeTag->description, $attributeDescription);
        $this->assertEquals($this->testProduct->tags()->find($compatibilityTag->tag->id)->type, TagType::Compatibility);
        $this->assertEquals($this->testProduct->tags()->find($compatibilityTag->tag->id)->compatibilityTag->description, $compatibilityDescription);
    }
}
