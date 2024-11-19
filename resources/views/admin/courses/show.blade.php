<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Courses Details') }}
            </h2>
        </div>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 flex flex-col gap-y-5">
                <div class="item-card flex flex-row gap-y-10 justify-between items-center">
                    <div class="flex flex-row items-center gap-x-3">
                        <img src="{{Storage::url($course->thumbnail)}}" alt="" class="rounded-2xl object-cover w-[200px] h-[150px]">
                        <div class="flex flex-col">
                            <h3 class="text-indigo-950 text-xl font-bold">{{$course->name}}</h3>
                            <p class="text-slate-500 text-sm">{{$course->category->name}}</p>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-slate-500 text-sm">Students</p>
                        <h3 class="text-indigo-950 text-xl font-bold">{{$course->students->count()}}</h3>
                    </div>
                    <div class="flex flex-row items-center gap-x-3">
                        <a href="{{route('admin.courses.edit', $course)}}" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                            Edit Course
                        </a>
                    </div>
                </div>

                <hr class="my-5">

                <div class="flex flex-row justify-between items-center">
                    <div class="flex flex-col">
                        <h3 class="text-indigo-950 text-xl font-bold">Course Videos</h3>
                        <p class="text-slate-500 text-sm">{{$course->course_videos->count()}} Total Videos</p>
                    </div>
                    <a href="{{route('admin.course.add_video', $course->id)}}" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                        Add New Video
                    </a>
                </div>

                @forelse($course->course_videos as $video)
                    <div class="item-card flex flex-row gap-y-10 justify-between items-center">
                        <div class="flex flex-row items-center gap-x-3">
                            <iframe width="560" class="rounded-2xl object-cover w-[120px] h-[90px]" height="315" src="https://www.youtube.com/embed/{{$video->path_video}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            <div class="flex flex-col">
                                <h3 class="text-indigo-950 text-xl font-bold">{{$video->name}}</h3>
                                <p class="text-slate-500 text-sm">{{$video->course->name}}</p>
                            </div>
                        </div>

                        <div class="flex flex-row items-center gap-x-3">
                            <a href="{{route('admin.course_videos.edit', $video)}}" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                                Edit Video
                            </a>
                            
                            <!-- Delete Video Form -->
                            <form action="{{ route('admin.course_videos.destroy', $video) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="font-bold py-4 px-6 bg-red-700 text-white rounded-full">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p>No videos available</p>
                @endforelse
                
            </div>
        </div>
    </div>
</x-app-layout>
