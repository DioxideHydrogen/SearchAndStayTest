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
					<p>Update a book</p>
				</div>
			</div>
			<fieldset>
				<form id="form-update" method="post">
					<div class="form-group">
						<label for="name">Name</label>
						<input type="text" class="form-control" value="{{ $book->name }}" name="name" id="name" placeholder="Name" required>
					</div>
					<div class="form-group">
						<label for="isbn">ISBN</label>
						<input type="text" class="form-control" value="{{ $book->isbn }}" name="isbn" id="isbn" placeholder="ISBN" required>
					</div>
					<div class="form-group">
						<label for="value">Value</label>
						<input type="text" class="form-control" value="{{ $book->value }}" name="value" id="value" placeholder="Value" required>
					</div>
					<button type="submit" id="btn-submit" class="btn btn-success mt-2">
						Update
					</button>
				</form>
			</fieldset>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.8/jquery.mask.min.js" integrity="sha512-hAJgR+pK6+s492clbGlnrRnt2J1CJK6kZ82FZy08tm6XG2Xl/ex9oVZLE6Krz+W+Iv4Gsr8U2mGMdh0ckRH61Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script>
		$(document).ready(function(){
			$("#isbn").mask('###00', {reverse: true});
			$("#value").mask('#,##0.00', {reverse: true});
			$("#btn-submit").on('click', async function(eve){
				
				eve.preventDefault();

				let form = $("#form-update").get(0);

				if(!form.reportValidity()) return 0;

				let request = await axios({
					method: 'PUT',
					url: `{{route('books.update', $book->id)}}`,
					data: {
						name: $("#name").val(),
						isbn: $("#isbn").val(),
						value: $("#value").val()
					}
				});

				if(request.status === 200) window.location = "{{route('books.list')}}";
			});
		})
	</script>
</body>
</html>