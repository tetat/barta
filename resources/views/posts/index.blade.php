<section
    id="newsfeed"
    class="space-y-6">
    @foreach($posts as $post)
        <!-- Barta Card -->
        <article
            class="bg-white border-2 border-black rounded-lg shadow mx-auto max-w-none px-4 py-5 sm:px-6">
            <!-- Barta Card Top -->
            <header>
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                <!-- User Avatar -->
                    <div class="flex-shrink-0">
                        @if ($post->user->getFirstMediaUrl)
                            <img
                            class="h-10 w-10 rounded-full object-cover"
                            src="https://avatars.githubusercontent.com/u/61485238"
                            alt="{{ $post->user->firstName }}" />
                        @else
                            <span class="text-xl rounded-full">{{ substr($post->user->firstName, 0, 1) . substr($post->user->lastName, 0, 1)}}</span>
                         @endif
                    </div>
                <!-- /User Avatar -->

                <!-- User Info -->
                <div class="text-gray-900 flex flex-col min-w-0 flex-1">
                    <a
                    href="{{ route('users.show', $post->user_id) }}"
                    class="hover:underline font-semibold line-clamp-1">
                    {{ $post->user->firstName . ' ' . $post->user->lastName}}
                    </a>

                    <a
                    href="{{ route('users.show', $post->user_id) }}"
                    class="hover:underline text-sm text-gray-500 line-clamp-1">
                    {{ '@' . $post->user->handle }}
                    </a>
                </div>
                <!-- /User Info -->
                </div>

                @auth
                    @if ($post->user_id === auth()->user()->id)
                    <!-- Card Action Dropdown -->
                    <div class="flex flex-shrink-0 self-center" x-data="{ open: false }">
                        <div class="relative inline-block text-left">
                            <div>
                            <button
                                @click="open = !open"
                                type="button"
                                class="-m-2 flex items-center rounded-full p-2 text-gray-400 hover:text-gray-600"
                                id="menu-0-button">
                                <span class="sr-only">Open options</span>
                                <svg
                                class="h-5 w-5"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                                aria-hidden="true">
                                <path
                                    d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM10 8.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM11.5 15.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0z"></path>
                                </svg>
                            </button>
                            </div>
                            <!-- Dropdown menu -->
                            <div
                                    x-show="open"
                                    @click.away="open = false"
                                    class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                    role="menu"
                                    aria-orientation="vertical"
                                    aria-labelledby="user-menu-button"
                                    tabindex="-1">
                                <a
                                    href="{{ route('posts.edit', $post->id) }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                    role="menuitem"
                                    tabindex="-1"
                                    id="user-menu-item-0"
                                >Edit</a
                                >
                                <div 
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                    role="menuitem"
                                    tabindex="-1"
                                    id="user-menu-item-2">
                                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                        
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="text-red-800 text-sm"
                                        onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Card Action Dropdown -->
                    @endif
                @endauth
            </div>
            </header>

            <!-- Content -->
            <div class="py-4 text-gray-700 font-normal">
            <p>
                {{ $post->body }}
            </p>
            </div>

            <!-- Date Created & View Stat -->
            <div class="flex items-center gap-2 text-gray-500 text-xs my-2">
            <span class="">6 minutes ago</span>
            <span class="">•</span>
            <span>450 views</span>
            </div>

            <!-- Barta Card Bottom -->
            <!-- /Barta Card Bottom -->
        </article>
        <!-- /Barta Card -->
    @endforeach

    <div>
        {{ $posts->links() }}
    </div>

    <!-- Barta Card With Image -->
    <!-- /Barta Card With Image -->
</section>
