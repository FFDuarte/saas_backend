App\Models\Tenant::all()->runForEach(function () {
    App\Models\Pecas::factory()->create();
});


App\Models\Tenant::select('bar')->run(function () {
    App\Models\User::factory()->create();
});