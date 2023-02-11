<x-app-layout>

    @if ($errors->any())
        <div class="rounded p-2 pl-3 mb-2 bg-danger text-white">
            @foreach ($errors->all() as $error)
                <li>
                        {{$error}}
                </li>
            @endforeach
        </div>
    @endif

    <div class="flex justify-center p-6">
        <div class="block p-6 rounded-sm shadow-lg bg-white w-full">
            <form method="POST" action="/add-task">
                @csrf
                <div class="flex justify-center">
                    <div class="mb-3 xl:w-96">
                        <label for="exampleFormControlTextarea1" class="form-label inline-block mb-2 text-gray-700"
                        >Todo</label
                        >
                        <textarea
                            class="
                                form-control
                                block
                                w-full
                                px-3
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
                                focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none
                              "
                            id="task"
                            name="task"
                            rows="3"
                            placeholder=""
                        ></textarea>

                        <x-primary-button class="mt-2">
                            {{ __('Add Task') }}
                        </x-primary-button>

                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="p-6">
        <div class="todos w-full rounded-sm shadow-lg">
            <div class="todos-section incomplete">
                <p>Incomplete</p>
                @foreach($incomplete_tasks as $task)
                    <div class="todo rounded-lg shadow-lg p-2 bg-white">
                        <p>{{$task['task']}}</p>
                        <div class="actions">
                            <a class="btn complete" href="/complete-task/{{$task['id']}}">
                                Complete
                            </a>
                            <a class="btn delete" href="/delete-task/{{$task['id']}}">Delete</a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="todos-section complete">
                <p>Completed</p>
                @foreach($complete_tasks as $task)
                    <div class="todo rounded-lg shadow-lg p-2 bg-white">
                        <p>{{$task['task']}}</p>
                        <div class="actions">
                            <a class="btn delete" href="/delete-task/{{$task['id']}}">Delete</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
