<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubsribeTransactionRequest;
use App\Models\Category;
use App\Models\Course;
use App\Models\SubscribeTransaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class frontController extends Controller
{
    public function index() {

        $courses = Course::with(['category','teacher','students'])->orderByDesc('id')->get();
        return view('front.index', compact('courses'));
    }

    public function details(Course $course) {
        return view('front.details', compact('course'));
    }

    public function category(Category $category) {
        $courses = $category->courses()->get();
        return view('front.category', compact('courses'));
    }

    public function pricing() {
        return view('front.pricing');
    }

    public function checkout() {
        return view('front.checkout');
    }

    public function checkout_store(StoreSubsribeTransactionRequest $request) {
        $user = Auth::user();

        $user = Auth::user();
        if($user->hasActiveSubscription()) {
            return redirect()->route('front.index');
        }

        DB::transaction(function () use ($request, $user) {
            $validated = $request->validated();
            
            if($request->hasFile('proof')){
                $proofPath = $request->file('proof')->store('proofs', 'public');
                $validated['proof'] = $proofPath;
            }

            $validated['user_id'] = $user->id;
            $validated['total_amount'] = 429000;
            $validated['is_paid'] = false;
            $transaction = SubscribeTransaction::create($validated);
        });

        return redirect()->route('dashboard');

    }

    public function learning(Course $course, $courseVideo){

        $user = Auth::user();
        if(!$user->hasActiveSubscription()) {
            return redirect()->route('front.pricing');
        }

        $video = $course->course_videos->firstWhere('id',  $courseVideo);

        $user->courses()->syncWithoutDetaching($course->id);

        return view('front.learning', compact('course','video'));
    }
}
