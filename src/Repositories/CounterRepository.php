<?php

namespace Adminetic\Website\Repositories;

use Adminetic\Website\Contracts\CounterRepositoryInterface;
use Adminetic\Website\Http\Requests\CounterRequest;
use Adminetic\Website\Models\Admin\Counter;
use Illuminate\Support\Facades\Cache;

class CounterRepository implements CounterRepositoryInterface
{
    // Counter Index
    public function indexCounter()
    {
        $counters = config('adminetic.caching', true)
            ? (Cache::has('counters') ? Cache::get('counters') : Cache::rememberForever('counters', function () {
                return Counter::latest()->get();
            }))
            : Counter::latest()->get();

        return compact('counters');
    }

    // Counter Create
    public function createCounter()
    {
        //
    }

    // Counter Store
    public function storeCounter(CounterRequest $request)
    {
        $counter = Counter::create($request->validated());
        $this->uploadImage($counter);
    }

    // Counter Show
    public function showCounter(Counter $counter)
    {
        return compact('counter');
    }

    // Counter Edit
    public function editCounter(Counter $counter)
    {
        return compact('counter');
    }

    // Counter Update
    public function updateCounter(CounterRequest $request, Counter $counter)
    {
        $counter->update($request->validated());
        $this->uploadImage($counter);
    }

    // Counter Destroy
    public function destroyCounter(Counter $counter)
    {
        isset($counter->icon) ? deleteImage($counter->icon) : '';
        $counter->delete();
    }

    // Upload Image
    protected function uploadImage(Counter $counter)
    {
        if (request()->has('icon')) {
            $counter->update([
                'icon' => request()->icon->store('website/counter', 'public'),
            ]);
            $image = Image::make(request()->file('icon')->getRealPath());
            $image->save(public_path('storage/'.$counter->icon));
        }
    }
}
