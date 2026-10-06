<?php

use App\Models\Product;
use App\Models\User;
use App\Policies\ProductPolicy;

test('admin can create update and delete products', function () {
    $policy = new ProductPolicy();

    $admin = new User();
    $admin->role = 'admin';

    $product = new Product();

    expect($policy->viewAny($admin))->toBeTrue()
        ->and($policy->create($admin))->toBeTrue()
        ->and($policy->update($admin, $product))->toBeTrue()
        ->and($policy->delete($admin, $product))->toBeTrue();
});

test('editor can create and update but cannot delete products', function () {
    $policy = new ProductPolicy();

    $editor = new User();
    $editor->role = 'editor';

    $product = new Product();

    expect($policy->viewAny($editor))->toBeTrue()
        ->and($policy->create($editor))->toBeTrue()
        ->and($policy->update($editor, $product))->toBeTrue()
        ->and($policy->delete($editor, $product))->toBeFalse();
});

test('user can view but cannot create update or delete products', function () {
    $policy = new ProductPolicy();

    $user = new User();
    $user->role = 'user';

    $product = new Product();

    expect($policy->viewAny($user))->toBeTrue()
        ->and($policy->view($user, $product))->toBeTrue()
        ->and($policy->create($user))->toBeFalse()
        ->and($policy->update($user, $product))->toBeFalse()
        ->and($policy->delete($user, $product))->toBeFalse();
});