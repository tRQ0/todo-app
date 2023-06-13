<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Things to-do</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>
    <div class="conatiner pt-5">
        <div class="row justify-content-center align-content-center">
            <div class="col col-8">
                <div class="card">
                    <div class="card-header">
                        <form data-action=" {{ route('todo.store') }}" name="addTodo" id="add-todo-form" class="form"
                            method="post">
                            @csrf
                            <div class="div row">
                                <div class="col">
                                    <select name="category" class="form-control form-select" required>
                                        <option value="" selected>
                                            Category
                                        </option>
                                        @foreach ($category as $item)
                                            <option value=" {{ $item->id }}">
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <input type="text" name="todoItem" class="form-control"
                                        placeholder="Type todo item name" required />
                                </div>
                                <div class="col">
                                    <button type="submit" class="form-control btn btn-outline-primary">Add</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <table name="todoTable" id="todo-table" class="table table-striped table-bordered">
                            <thead class="table-secondary">
                                <tr>
                                    <th>Todo item name</th>
                                    <th>Category</th>
                                    <th>Timestamp</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($category as $item)
                                    @foreach ($item->todos as $todo)
                                        <tr id="{{ $todo->id }}">
                                            <td>{{ $todo->name }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ date_format($todo->timestamp, 'dS F') }}</td>
                                            <td class="text-center">
                                                <button type="button" id="remove"
                                                    class="btn btn-danger">Delete</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div id="message"></div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/create_todo.js') }}" defer></script>
    <script src="{{ asset('js/delete_todo.js') }}" defer></script>

</body>

</html>
