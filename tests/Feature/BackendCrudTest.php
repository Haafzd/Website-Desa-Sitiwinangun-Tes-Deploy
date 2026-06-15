<?php

namespace Tests\Feature;

use App\Models\Artisan;
use App\Models\Category;
use App\Models\Collection;
use App\Models\HistoryPage;
use App\Models\User;
use App\Models\VirtualTour;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class BackendCrudTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;
    protected Category $category;
    protected Artisan $artisan;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('public');

        // Create admin user
        $this->admin = User::factory()->create([
            'role' => 'admin',
            'is_active' => true,
        ]);

        // Create basic Category
        $this->category = Category::create([
            'name' => 'Kendi & Wadah Air',
            'slug' => 'kendi-wadah-air',
            'color_hex' => '#6B3D14',
            'description' => 'Simbol air kehidupan',
            'sort_order' => 1,
        ]);

        // Create basic Artisan
        $this->artisan = Artisan::create([
            'name' => 'Maestro Sutiwan',
            'address' => 'RT 01 RW 02 Sitiwinangun',
            'is_featured' => true,
            'sort_order' => 1,
        ]);

        // Create default virtual tour row (needed by controller)
        VirtualTour::create([
            'title' => 'Tour Default',
            'description' => 'Tour desc',
            'embed_type' => 'pannellum',
            'embed_code' => '<iframe></iframe>',
            'sanitized_code' => '<iframe></iframe>',
            'is_active' => true,
        ]);

        // Create default history rows (needed by static content controller)
        HistoryPage::create([
            'page_key' => 'museum_profile',
            'title' => 'Profile',
            'content' => 'profile content',
        ]);
    }

    /**
     * Test admin dashboard stats.
     */
    public function test_admin_dashboard_can_be_rendered(): void
    {
        // Add one collection to verify stats count
        Collection::create([
            'name' => 'Kendi Air Tradisional',
            'slug' => 'kendi-air-tradisional',
            'category_id' => $this->category->id,
            'photo_url' => 'collections/kendi.jpg',
            'description' => 'Kendi tanah liat manual.',
            'history_origin' => 'Digunakan turun temurun.',
            'technique' => 'Hand-pressed',
            'materials' => 'Tanah liat, pasir',
            'artisan_id' => $this->artisan->id,
            'location' => 'Sitiwinangun',
            'year' => 2024,
            'status' => 'published',
            'created_by' => $this->admin->id,
        ]);

        $response = $this->actingAs($this->admin)->get(route('admin.dashboard'));

        $response->assertStatus(200);
        $response->assertViewHas('stats');
    }

    /**
     * Test Collection CRUD.
     */
    public function test_admin_can_create_collection(): void
    {
        $file = UploadedFile::fake()->create('kendi.jpg', 100, 'image/jpeg');

        $response = $this->actingAs($this->admin)->post(route('admin.collections.store'), [
            'name' => 'Kendi Baru',
            'category_id' => $this->category->id,
            'artisan_id' => $this->artisan->id,
            'photo' => $file,
            'description' => 'Kendi hias unik.',
            'history_origin' => 'Asal mula gerabah.',
            'philosophy' => 'Tanpa pamrih',
            'technique' => 'Pilin',
            'materials' => 'Tanah liat',
            'location' => 'Sitiwinangun RT 03',
            'year' => 2025,
            'status' => 'published',
        ]);

        $response->assertRedirect(route('admin.collections.index'));
        $this->assertDatabaseHas('collections', [
            'name' => 'Kendi Baru',
            'slug' => 'kendi-baru',
            'status' => 'published',
        ]);
        
        // Assert file was stored
        $collection = Collection::where('name', 'Kendi Baru')->first();
        Storage::disk('public')->assertExists($collection->photo_url);
    }

    /**
     * Test Virtual Tour Configuration & Rollback.
     */
    public function test_admin_can_update_virtual_tour_and_rollback(): void
    {
        $response = $this->actingAs($this->admin)->put(route('admin.virtual-tour.update'), [
            'title' => 'Tour Baru',
            'description' => 'Deskripsi Baru',
            'embed_type' => 'iframe',
            'embed_code' => '<iframe src="https://www.google.com/maps/embed"></iframe>',
            'is_active' => true,
        ]);

        $response->assertRedirect(route('admin.virtual-tour.index'));
        $this->assertDatabaseHas('virtual_tour', [
            'title' => 'Tour Baru',
            'embed_type' => 'iframe',
        ]);

        $tour = VirtualTour::first();
        $this->assertCount(1, $tour->version_history);

        // Test rollback
        $version = $tour->version_history[0]['version'];
        $rollbackResponse = $this->actingAs($this->admin)->post(route('admin.virtual-tour.rollback', $version));
        $rollbackResponse->assertRedirect(route('admin.virtual-tour.index'));
    }

    /**
     * Test Static Content editing.
     */
    public function test_admin_can_update_static_museum_profile(): void
    {
        $response = $this->actingAs($this->admin)->put(route('admin.museum-profile.update'), [
            'title' => 'Museum Baru',
            'content' => 'Deskripsi museum baru abdimas.',
        ]);

        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('history_pages', [
            'page_key' => 'museum_profile',
            'title' => 'Museum Baru',
            'content' => 'Deskripsi museum baru abdimas.',
        ]);
    }
}
