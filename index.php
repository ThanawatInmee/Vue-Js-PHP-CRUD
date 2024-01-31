<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title>
		Crud Vue.js
	</title>

	<!-- Links -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

	<!-- Scripts -->
	<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
	<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
	<script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>

	<!-- Css -->
	<style type="text/css">
		
		@import url('https://fonts.googleapis.com/css2?family=Kanit&display=swap');

		* {
			font-family: 'Kanit', sans-serif;
			color: white;
		}

		body {
			background: #111111;
		}

	</style>

</head>
<body>

	<!-- Container -->
	<div class="container mt-5" id="app">

		<br>
		<h3 align="center">
			{{ title }}
		</h3>
		<hr>
		<div class="row">

			<div class="col-md-6">
				<br>
				<h3 class="panel-title">
					Users Data
				</h3>
				<br>
			</div>

			<div class="col-md-6" align="right">
				<button class="btn btn-outline-primary btn-sm w-25" @click="openModel">
					Insert
				</button>
				&nbsp;
				<button class="btn btn-outline-danger btn-sm w-25" v-if="cancelButton" @click="cancel">
					Cancel
				</button>
			</div>

		</div>

		<div class="row" v-if="Model">

			<div class="col-md-6 mb-3">
				<label class="form-label">
					Username
				</label>
				<input type="text" v-model="username" class="form-control">
			</div>

			<div class="col-md-6 mb-3">
				<label class="form-label">
					Password
				</label>
				<input type="text" v-model="password" class="form-control">
			</div>

			<div class="col-md-12 mb-3">
				<input type="hidden" v-model="id" class="form-control mb-3">
				<input class="btn btn-outline-primary btn-sm w-100" v-model="Button" @click="Submit"></input>
			</div>

		</div>

		<!-- Table -->
		<div class="table-responsive">
			<table class="table table-bordered table-dark">
				<thead>
					<th>Username</th>
					<th>Password</th>
					<th>Edit</th>
					<th>Delete</th>
				</thead>
				<tbody>
					<tr v-for="row in users">
						<td> {{ row.username }} </td>
						<td> {{ row.password }} </td>
						<td>
							<button class="btn btn-outline-warning btn-sm edit" @click="fetchData(row.id)">
								Edit
							</button>
						</td>
						<td>
							<button class="btn btn-outline-danger btn-sm" @click="deleteData(row.id)">
								Delete
							</button>
						</td>
					</tr>
				</tbody>
			</table>
		</div>

	</div>

	<script type="text/javascript">
		
		let app = new Vue({
			el: "#app",
			data :{
				users: '',
				Model: false,
				Button: 'Insert',
				id: null,
				title: 'CRUD APP using VueJS & PHP',
				cancelButton: false
			},
			methods: {
				fetch() {
					axios.post('fetch.php', {
						action: 'fetchall'
					}).then(res => {
						app.users = res.data;
					});
				},
				openModel() {
					app.username = '';
					app.password = '';
					app.Model = true;
					app.Button = 'Insert';
					app.title = 'Insert Data';
					app.cancelButton = true;
				},
				Submit() {
					if (app.username != '' && app.password != '') {
						if (app.Button == "Insert") {
							axios.post('add.php', {
								action: 'insert',
								username: app.username,
								password: app.password
							}).then(function(res) {
								app.Model = false;
								app.fetch();
								app.username = '';
								app.password = '';
								alert(res.data.message);
								window.location.reload();
							});
						} else if (app.Button == "Update") {
							axios.post('update.php', {
								action: 'update',
								username: app.username,
								password: app.password,
								id: app.id
							}).then(function(res) {
								app.Model = false;
								app.fetch();
								app.username = '';
								app.password = '';
								app.id = '';
								alert(res.data.message);
								window.location.reload();
							});
						}
					} else {
						alert("Fill All Field");
					}
				},
				fetchData(id) {
					axios.post('data.php', {
						action: 'data',
						id: id
					}).then(res => {
						app.username = res.data.username;
						app.password = res.data.password;
						app.id = res.data.id;
						app.Model = true;
						app.Button = 'Update';
						app.title = 'Update Data';
						app.cancelButton = true;
					})
				},
				deleteData(id) {
					if (confirm('Are your sure you want to remove this data?')) {
						axios.post('delete.php', {
							action: 'delete',
							id: id
						}).then(res => {
							app.fetch();
							alert(res.data.message);
							window.location.reload();
						})
					}
				},
				cancel() {
					if (app.Model == true) {
						alert('Cancel Model Success');
						app.Model = false;
						app.cancelButton = false;
						app.title = 'CRUD APP using VueJS & PHP';
					} else {
						alert('Not Open Model');
					}
				}
			},
			created() {
				this.fetch();
			}
		})

	</script>

</body>
</html>