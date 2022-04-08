<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Repositories\ContactRepository;
use App\Repositories\UserRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * @type ContactRepository
     */
    protected ContactRepository $contactRepository;

    /**
     * @var GateContract
     */
    protected GateContract $gate;

    /**
     * @var UserRepository
     */
    protected UserRepository $userRepository;

    public function __construct(ContactRepository $contactRepository, GateContract $gate, UserRepository $userRepository)
    {
        $this->contactRepository = $contactRepository;
        $this->gate = $gate;
        $this->userRepository = $userRepository;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $contacts = $this->contactRepository->userContacts($this->userRepository->authUser());

        return response()->json($contacts);
    }

    /**
     * @param Contact $contact
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function show(Contact $contact): JsonResponse
    {
        $this->gate->authorize('view', $contact);

        return response()->json($contact);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'number' => ['required', 'string', 'max:255', 'regex:/^[0-9\+wp\(\) ]+$/']
        ]);

        $this->contactRepository->store($this->userRepository->authUser(), $request->all());

        return response()->json(['success' => true]);
    }

    /**
     * @param Request $request
     * @param Contact $contact
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(Request $request, Contact $contact): JsonResponse
    {
        $this->gate->authorize('update', $contact);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'number' => ['required', 'string', 'max:255', 'regex:/^[0-9\+wp\(\) ]+$/']
        ]);

        $this->contactRepository->update($contact, $request->all());

        return response()->json(['success' => true]);
    }

    /**
     * @param Request $request
     * @param Contact $contact
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function setFavorite(Request $request, Contact $contact): JsonResponse
    {
        $this->gate->authorize('update', $contact);

        $request->validate([
            'favorite' => ['required'],
        ]);

        $this->contactRepository->setFavorite($contact, $request->input('favorite'));

        return response()->json(['success' => true]);
    }

    /**
     * @param Contact $contact
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(Contact $contact): JsonResponse
    {
        $this->gate->authorize('delete', $contact);

        $this->contactRepository->destroy($contact);

        return response()->json(['success' => true]);
    }
}