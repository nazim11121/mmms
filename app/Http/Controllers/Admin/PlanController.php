<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PlanController extends Controller
{
    public function index()
    {
        $plans = SubscriptionPlan::orderBy('sort_order')->get();
        return view('admin.plans.index', compact('plans'));
    }

    public function create()
    {
        return view('admin.plans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'duration_days' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'features' => 'nullable|array',
        ]);

        SubscriptionPlan::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'price' => $request->price,
            'duration_days' => $request->duration_days,
            'features' => $request->features ?? [],
            'is_popular' => $request->boolean('is_popular'),
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('admin.plans.index')->with('success', 'Plan created!');
    }

    public function edit(SubscriptionPlan $plan)
    {
        return view('admin.plans.edit', compact('plan'));
    }

    public function update(Request $request, SubscriptionPlan $plan)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'duration_days' => 'required|integer|min:1',
        ]);

        $plan->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'price' => $request->price,
            'duration_days' => $request->duration_days,
            'features' => $request->features ?? [],
            'is_active' => $request->boolean('is_active'),
            'is_popular' => $request->boolean('is_popular'),
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('admin.plans.index')->with('success', 'Plan updated!');
    }

    public function destroy(SubscriptionPlan $plan)
    {
        $plan->delete();
        return redirect()->route('admin.plans.index')->with('success', 'Plan deleted.');
    }
}
