@extends('layouts.app')
@section('content')
<div class="container 2xl:w-4/5 mx-auto py-5 md:py-10 px-6 bg-white shadow md:shadow-md">
    <h1>
      Manage Users
    </h1>
    <div class="users">
      <table>
        <thead>
          <tr>
            <th>Name</th>
            <th>Username</th>
            <th class="hidden md:table-cell">Email</th>
            <th class="hidden md:table-cell">Mobile</th>
            <th class="hidden lg:table-cell">Admin</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
          <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->username }}</td>
            <td class="hidden md:table-cell">{{ $user->email }}</td>
            <td class="hidden md:table-cell">{{ $user->mobile }}</td>
            <td class="hidden lg:table-cell">
              @if($user->is_admin == 1)
                Yes
              @else
                No
              @endif
            </td>
            <td>
              @if($user->is_admin == 1)
                @if(isset(Auth::user()->id) && Auth::user()->id != $user->id)
                  <a href="unset-admin/{{ $user->id }}" class="btn-pink">Remove Admin</a>
                @else
                  <span>Self</span>
                @endif
              @else
                <a href="set-admin/{{ $user->id }}" class="btn-blue">Make Admin</a>
              @endif
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
    {{-- Pagination --}}
    <div class="flex justify-center post-pagination">
        {{ $users->links() }}
    </div>

</div>
@endsection