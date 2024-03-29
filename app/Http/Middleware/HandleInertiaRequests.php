<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;

use App\Enums\QuizType as QuizTypeEnum;
use App\Enums\ActiveStatus as ActiveStatusEnum;
use App\Traits\ObjectToSelectOptions;


class HandleInertiaRequests extends Middleware
{
    use ObjectToSelectOptions;

    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $request->user(),
            ],

            'appName' => config('app.name', ''),
            'notification' => session()->get('notification'),
            'enums' => [
                'activeStatuses' => ActiveStatusEnum::array(),
                'quizTypes' => QuizTypeEnum::array(),
            ],
            'selectOptions' => [
                'activeStatuses' => $this->objectFoSelectOptions(ActiveStatusEnum::array()),
                'quizTypes' => $this->objectFoSelectOptions(QuizTypeEnum::array()),
            ],

            'ziggy' => function () use ($request) {
                return array_merge((new Ziggy)->toArray(), [
                    'location' => $request->url(),
                ]);
            },
        ]);
    }
}
