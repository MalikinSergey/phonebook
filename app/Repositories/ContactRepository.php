<?php

namespace App\Repositories;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ContactRepository
{

    /**
     * @param int $id
     * @return Contact
     * @throws ModelNotFoundException<Model>
     */
    public function findById(int $id): Contact
    {
        return Contact::findOrFail($id);
    }

    /**
     * @param User $user
     * @return Collection
     */
    public function userContacts(User $user): Collection
    {
        $contacts = $user->contacts()->orderBy('favorite', 'desc')->orderBy('name', 'asc')->get();

        return $contacts;
    }

    /**
     * @param User $user
     * @param array $data
     * @return Contact
     */
    public function store(User $user, array $data): Contact
    {
        $contact = new Contact($data);

        $user->contacts()->save($contact);

        return $contact;
    }

    /**
     * @param Contact $contact
     * @param bool $favorite
     */
    public function setFavorite(Contact $contact, bool $favorite): void
    {
        $contact->update(['favorite' => $favorite]);
    }

    /**
     * @param Contact $contact
     * @param array $data
     */
    public function update(Contact $contact, array $data)
    {
        $contact->update($data);
    }

    /**
     * @param Contact $contact
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
    }
}