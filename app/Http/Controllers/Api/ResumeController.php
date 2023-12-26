<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResumeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $resumes = Auth::user()->resume()->with(['basic', 'work', 'education'])->get();

        return response()->json([
            'resumes' => $resumes
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $id): JsonResponse
    {
        $resume = Auth::user()->resume()->with(['basic', 'work', 'education'])->find($id);

        if (!$resume) {
            return response()->json([
                'message' => 'Resume does not belong to user'
            ], 406);
        }

        return response()->json(
            $resume
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $user = Auth::user();

        $request->validate([
            '*' => 'max:255',
            'basics.name' => 'required|min:1',
            'basics.email' => 'required|email',
            'basics.surname' => 'required',
            'education.*.school' => 'required',
            'education.*.faculty' => 'required',
            'education.*.direction' => 'required',
            'education.*.from' => 'required',
            'work.*.employer' => 'required',
            'work.*.position' => 'required',
            'work.*.from' => 'required',
        ]);

        $resume = $user->resume()->create([
            'name' => $request->post('name') ?? ''
        ]);

        if ($request->post('basics')) {
            $resume->basic()->create([
                'resume_id' => $resume->id,
                'name' => $request->post('basics')['name'],
                'surname' => $request->post('basics')['surname'],
                'email' => $request->post('basics')['email'] ?? null,
                'phoneNumber' => $request->post('basics')['phoneNumber'] ?? null,
                'website' => $request->post('basics')['website'] ?? null,
                'address' => $request->post('basics')['address'] ?? null,
                'country' => $request->post('basics')['country'] ?? null,
                'city' => $request->post('basics')['city'] ?? null,
                'zipcode' => $request->post('basics')['zipcode'] ?? null,
            ]);
        }

        if ($request->post('education')) {
            foreach ($request->post('education') as $education) {
                $resume->education()->create([
                    'resume_id' => $resume->id,
                    'school' => $education['school'],
                    'faculty' => $education['faculty'],
                    'direction' => $education['direction'],
                    'from' => $education['from'],
                    'to' => $education['to'] ?? null,
                    'level' => $education['level'] ?? null,
                    'description' => $education['description'] ?? null,
                ]);
            }
        }

        if ($request->post('work')) {
            foreach ($request->post('work') as $work) {
                $resume->work()->create([
                    'resume_id' => $resume->id,
                    'employer' => $work['employer'],
                    'position' => $work['position'],
                    'type' => $work['type'] ?? null,
                    'from' => $work['from'],
                    'to' => $work['to'] ?? null,
                    'description' => $work['description'] ?? null,
                ]);
            }
        }

        return response()->json([
            'resume_id' => $resume->id,
            'message' => 'Resume successfully created!'
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $user = Auth::user();

        $resume = $user->resume()->with(['basic', 'education', 'work'])->find($id);

        if (!$resume) {
            return response()->json([
                'message' => 'Resume does not belong to user'
            ], 406);
        }

        $validate = $request->validate([
            '*' => 'min:1|max:255',
            'basics.name' => 'required',
            'basics.surname' => 'required',
            'basics.email' => 'email',
            'education.*.school' => 'required',
            'education.*.faculty' => 'required',
            'education.*.direction' => 'required',
            'education.*.from' => 'required',
            'work.*.employer' => 'required',
            'work.*.position' => 'required',
            'work.*.from' => 'required',
        ]);

        $resume->name = $request->post('name') ?? '';
        $resume->save();

        if ($request->post('basics')) {
            $resume->basic()->updateOrCreate(
                ['id' => $resume->basic->id],
                [
                    'resume_id' => $resume->id,
                    'name' => $request->post('basics')['name'],
                    'surname' => $request->post('basics')['surname'],
                    'email' => $request->post('basics')['email'] ?? null,
                    'phoneNumber' => $request->post('basics')['phoneNumber'] ?? null,
                    'website' => $request->post('basics')['website'] ?? null,
                    'address' => $request->post('basics')['address'] ?? null,
                    'country' => $request->post('basics')['country'] ?? null,
                    'city' => $request->post('basics')['city'] ?? null,
                    'zipcode' => $request->post('basics')['zipcode'] ?? null,
                ]
            );
        }

        if ($request->post('education')) {
            foreach ($request->post('education') as $education) {
                if (isset($education['deleted']) && $education['deleted']) {
                    $resume->education->find($education['id'])->delete();
                    continue;
                }
                $resume->education()->updateOrCreate(
                    ['id' => $education['id']],
                    [
                        'resume_id' => $resume->id,
                        'school' => $education['school'],
                        'faculty' => $education['faculty'],
                        'direction' => $education['direction'],
                        'from' => $education['from'],
                        'to' => $education['to'] ?? null,
                        'level' => $education['level'] ?? null,
                        'currentlyActive' => $work['currentlyActive'] ?? null,
                        'description' => $education['description'] ?? null,
                    ]
                );
            }
        }

        if ($request->post('work')) {
            foreach ($request->post('work') as $work) {
                if (isset($work['deleted']) && $work['deleted']) {
                    $resume->work->find($work['id'])->delete();
                    continue;
                }
                $resume->work()->updateOrCreate(
                    ['id' => $work['id']],
                    [
                        'resume_id' => $resume->id,
                        'employer' => $work['employer'],
                        'position' => $work['position'],
                        'type' => $work['type'] ?? null,
                        'from' => $work['from'],
                        'to' => $work['to'] ?? null,
                        'currentlyActive' => $work['currentlyActive'] ?? null,
                        'description' => $work['description'] ?? null,
                    ]
                );
            }
        }

        return response()->json([
            'message' => 'Updated successfully',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $user = Auth::user();
            $resume = $user->resume()->find($id);
        } catch (\Exception $ex) {
            return response()->json([
                'message' => 'Encountered an error during deletion process. Error code ' . $ex->getCode(),
            ], 400);
        }

        if (!$resume) {
            return response()->json([
                'message' => 'Resume could not be deleted',
            ], 400);
        }

        $resume->basic->delete();
        $resume->work()->delete();
        $resume->education()->delete();
        $resume->delete();

        return response()->json([
            'message' => 'Resume and associated details deleted successfully',
        ]);
    }
}
