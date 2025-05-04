<?php

namespace App\Policies;

use App\Models\CmsPage;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CmsPagePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $this->isAdminOrEditor($user);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, CmsPage $cmsPage): bool
    {
        return $this->isAdminOrEditor($user);
    }

    /**
     * Determine whether the user can view draft pages.
     */
    public function viewDraft(User $user): bool
    {
        return $this->isAdminOrEditor($user);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $this->isAdminOrEditor($user);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, CmsPage $cmsPage): bool
    {
        return $this->isAdminOrEditor($user);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, CmsPage $cmsPage): bool
    {
        return $this->isAdmin($user);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, CmsPage $cmsPage): bool
    {
        return $this->isAdmin($user);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, CmsPage $cmsPage): bool
    {
        return $this->isAdmin($user);
    }

    /**
     * Check if user is an admin or editor
     */
    protected function isAdminOrEditor(User $user): bool
    {
        return $this->isAdmin($user) || $user->role === 'editor';
    }

    /**
     * Check if user is an admin
     */
    protected function isAdmin(User $user): bool
    {
        return $user->role === 'admin' || $user->email === 'johnson@manifestghana.com';
    }
}
