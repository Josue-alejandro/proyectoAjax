$(function() {

	let editar = false;



	//########### esta sección es el script del buscador ###########
	
	$('#task-result').hide();
	fetchtask();

	$('#search').keyup(function(e) {
		if ($('#search').val()) {
			let search = $('#search').val();
		$.ajax ({
			url:'buscador.php',
			type:'POST',
			data: { search },
			success: function(response) {
			let data = JSON.parse(response);
			let template = '';

		    data.forEach( data => {
		    	template += `<li>
		    	${data.nombre}
		    	</li>`
		    })

		    $('#container').html(template);
		    $('#task-result').show();

		}

		})
		}
	});

	//######## esta seccion envia los datos a add.php y recibe la respuesta ###########

	$('#task-form').submit(function (e) {
		const postData = {
			name: $('#titulo').val(), // nombre de la tarea
			description: $('#descripcion').val(), // descripción de la tarea
			id: $('#taskId').val()
		};

		let url = editar === false ? 'add.php' : 'edit.php';

		$.post(url, postData, function (response) {
			fetchtask();
			$('#task-form').trigger('reset'); //limpiar el formulario
			console.log(url);
			console.log(response)
		})

		e.preventDefault();
	});

	function fetchtask() {
		$.ajax({
		url: 'lista.php',
		type: 'GET',
		success: function (response) {
			let task = JSON.parse(response);
			let template = '';
			task.forEach(task => {
				template += `
				<tr taskId="${task.id}">
				    <td>${task.id}</td>
				    <td>
				    <a href="#" class="task-item">${task.nombre}</a>
				    </td>
				    <td>${task.descripcion}</td>
				    <td>${task.fecha}</td>
				    <td><button class= "task-delete btn btn-danger">Borrar</button>
				    </td>
				</tr>
				`
			});

			$('#tareas').html(template);
		}
	})
	}

	//########## esta seccion se encarga de eliminar la fila seleccionada ################

	$(document).on('click', '.task-delete', function(){
		if (confirm('¿estas seguro de eliminar esta tarea?')) {
			let elemento = $(this)[0].parentElement.parentElement;
		let id = $(elemento).attr('taskId');
		$.post('delete.php', {id}, function (response) {
			fetchtask();
		})
		}
	});

	$(document).on('click', '.task-item', function () {
		let elemento = $(this)[0].parentElement.parentElement;
		let id = $(elemento).attr('taskId');
		$.post('single.php', {id}, function (response) {
			const tarea = JSON.parse(response);
			$('#titulo').val(tarea.titulo);
			$('#descripcion').val(tarea.descripcion);
			$('#taskId').val(tarea.id);
			editar = true
		})
	})
});