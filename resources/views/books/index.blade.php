<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Books - {{env('APP_NAME')}}</title>
	@vite(['resources/js/app.js'])
</head>
<body>
	<div class="row justify-content-center mt-2">
		<div class="col-md-8">
			<div class="d-flex">
				<div>
					<h3>Books</h3>
					<p>Displaying a list of all books</p>
				</div>
				<div>
					<a href="{{route('books.create')}}" class="btn btn-primary mt-3 mx-4">Create new Book</a>
				</div>
			</div>
			<table class="table">
				<thead>
					<th>ID</th>
					<th>Name</th>
					<th>ISBN</th>
					<th>Value</th>
					<th>Actions</th>
				</thead>
				<tbody>
					@if($books)
						@foreach($books as $book)
							<tr>
								<td>{{ $book->id }}</td>
								<td>{{ $book->name }}</td>
								<td>{{ $book->isbn }}</td>
								<td>{{ number_format($book->value, 2) }}</td>
								<td>
									<a href="{{route('books.edit', $book->id)}}" class="btn btn-warning btn-sm">
										Edit
									</a>
									<button onclick="removeBook({{$book->id}})" class="btn btn-danger btn-sm">
										Delete
									</button>
								</td>
							</tr>
						@endforeach
					@endif
				</tbody>
			</table>

		</div>
	</div>
	<script>
		
		const removeBook = async (id) => {
			
			if(!window.confirm('Do you want to remove this book?')) return 0;

			
			let request = await axios({
				method: 'DELETE',
				url: `{{route('books.destroy', '')}}/${id}`,
			});

			if(request.status === 200) window.location.reload();

		}

	</script>
</body>
</html>