<x-app-layout>
    <x-slot name="title">
        Profil
    </x-slot>
  <!-- /.content -->
    @include('profile.partials.update-profile-information-form')
    @include('profile.partials.update-password-form')
    {{-- @include('profile.partials.delete-user-form') --}}
</x-app-layout>
