<div class="max-w-6xl mx-auto">
    {{-- The best athlete wants his opponent at his best. --}}

    <div class="flex justify-end m-2 p-2 mt-3">
        <x-jet-button wire:click="showPostModal">Create</x-jet-button>
    </div>

    <div class="m-2 p-2">
    <div class="flex flex-col">
    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 inline-block w-full sm:px-6 lg:px-8">
            @if(count($posts) > 0)
                <div class="overflow-hidden">
                    <table class="w-full">
                        <thead class="bg-gray-800 border-b">
                            <tr>
                            <th scope="col" class="text-sm font-medium text-gray-200 px-6 py-4 text-left">
                                #
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-200 px-6 py-4 text-left">
                                Title
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-200 px-6 py-4 text-left">
                                Image
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-200 px-6 py-4 text-right">
                                Action
                            </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $post)

                            <tr class="bg-gray-50 border-b">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{$post->id}}</td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        {{$post->title}}
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    <img src="{{Storage::url($post->image)}}" class="w-10 h-auto rounded-full" alt="">
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    <div class="flex space-x-2 justify-end">
                                        <x-jet-secondary-button wire:click="ShowEditPostModal({{$post->id}})">Edit</x-jet-secondary-button>
                                        <x-jet-danger-button class="ml-2" wire:click="deletePost({{$post->id}})">Delete</x-jet-danger-button>
                                    </div>
                                    </td>
                                </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else

            <div class="flex justify-center">
                <div class="block p-6 rounded-lg shadow-lg bg-white max-w-sm w-3/4 text-center">
                    <h5 class="text-gray-900 text-xl leading-tight font-medium  mb-6">No Post Found</h5>
                    <x-jet-button wire:click="showPostModal">Create a new post</x-jet-button>
                </div>
            </div>

            @endif
        </div>
    </div>
</div>

    </div>

    <div>
        <x-jet-dialog-modal wire:model="showPostModal">
            <x-slot name="title">
                    @if($isEditMode)
                    Update Post
                    @else
                    Create Post
                    @endif
            </x-slot>
            <x-slot name="content">
            <div class="col-span-6 mb-4">
                  <label for="title" class="block text-sm font-medium text-gray-700 pb-1">Title</label>
                  <input type="text" name="title" id="title" wire:model.lazy="title" autocomplete="title" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">

                  @error('title') <span class="text-red-400">{{ $message }}</span> @enderror
            </div>

            <div class="col-span-6 mb-4">
                <div class="mb-3 w-96">
                    <label for="formFile" class="form-label inline-block mb-2 text-gray-700">Image</label>
                    <input
                    wire:model="image"

                    class="form-control
                    block
                    w-full
                    pr-3
                    py-1.5
                    text-base
                    font-normal
                    text-gray-700
                    bg-white bg-clip-padding
                    border border-solid border-gray-300
                    rounded
                    transition
                    ease-in-out
                    m-0
                    focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" type="file" id="formFile">
                </div>
                @if ($image)
                    Photo Preview:
                    <img src="{{ $image->temporaryUrl() }}" width="100" height="100" alt="Preview">
                @endif

                @if ($oldImage)
                    Photo Preview:
                    <img src="{{ Storage::url($oldImage) }}" width="100" height="100" alt="Preview">
                @endif

                @error('image') <span class="text-red-400">{{ $message }}</span> @enderror
            </div>

            <div class="col-span-6 mb-4">
                <label for="content" class="block text-sm font-medium text-gray-700 pb-1">Content</label>
                <textarea wire:model.lazy="content" name="content" id="content" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Your message..."></textarea>

                @error('content') <span class="text-red-400">{{ $message }}</span> @enderror
            </div>
            </x-slot>
            <x-slot name="footer">

                    @if($isEditMode)
                    <x-jet-button wire:click="updatePost">
                        Update
                    </x-jet-button>
                    @else
                    <x-jet-button wire:click="savePost">
                        Create
                    </x-jet-button>
                    @endif

            </x-slot>
        </x-jet-dialog-modal>
    </div>
</div>
