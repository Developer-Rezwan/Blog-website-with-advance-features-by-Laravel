<template>
	<nav
		class="
			navbar navbar-expand navbar-light
			bg-white
			topbar
			mb-4
			static-top
			shadow
		"
	>
		<!-- Sidebar Toggle (Topbar) -->
		<button
			id="sidebarToggleTop"
			class="btn btn-link d-md-none rounded-circle mr-3"
		>
			<i class="fa fa-bars"></i>
		</button>

		<!-- Topbar Search -->
		<form
			class="
				d-none d-sm-inline-block
				form-inline
				mr-auto
				ml-md-3
				my-2 my-md-0
				mw-100
				navbar-search
			"
		>
			<div class="input-group">
				<input
					type="text"
					class="form-control bg-light border-0 small"
					placeholder="Search for..."
					aria-label="Search"
					aria-describedby="basic-addon2"
				/>
				<div class="input-group-append">
					<button class="btn btn-primary" type="button">
						<i class="fas fa-search fa-sm"></i>
					</button>
				</div>
			</div>
		</form>

		<!-- Topbar Navbar -->
		<ul class="navbar-nav ml-auto">
			<!-- Nav Item - Search Dropdown (Visible Only XS) -->
			<li class="nav-item dropdown no-arrow d-sm-none">
				<a
					class="nav-link dropdown-toggle"
					href="#"
					id="searchDropdown"
					role="button"
					data-toggle="dropdown"
					aria-haspopup="true"
					aria-expanded="false"
				>
					<i class="fas fa-search fa-fw"></i>
				</a>
				<!-- Dropdown - Messages -->
				<div
					class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
					aria-labelledby="searchDropdown"
				>
					<form class="form-inline mr-auto w-100 navbar-search">
						<div class="input-group">
							<input
								type="text"
								class="form-control bg-light border-0 small"
								placeholder="Search for..."
								aria-label="Search"
								aria-describedby="basic-addon2"
							/>
							<div class="input-group-append">
								<button class="btn btn-primary" type="button">
									<i class="fas fa-search fa-sm"></i>
								</button>
							</div>
						</div>
					</form>
				</div>
			</li>

			<!-- Nav Item - Alerts -->
			<li class="nav-item dropdown no-arrow mx-1">
				<a
					class="nav-link dropdown-toggle"
					href="#"
					id="alertsDropdown"
					role="button"
					data-toggle="dropdown"
					aria-haspopup="true"
					aria-expanded="false"
				>
					<i class="fas fa-bell fa-fw"></i>
					<!-- Counter - Alerts -->
					<span class="badge badge-danger badge-counter">{{
						state.alertNotifications.length
					}}</span>
				</a>
				<!-- Dropdown - Alerts -->
				<div
					class="
						dropdown-list dropdown-menu dropdown-menu-right
						shadow
						animated--grow-in
					"
					aria-labelledby="alertsDropdown"
				>
					<h6 class="dropdown-header">Alerts Center</h6>
					<a
						class="dropdown-item d-flex align-items-center"
						:href="``"
						v-for="(user, i) of state.alertNotifications"
						:key="i"
					>
						<div class="mr-3">
							<div class="icon-circle bg-primary">
								<i class="fas fa-file-alt text-white"></i>
							</div>
						</div>
						<div>
							<div class="small text-gray-500" id="timeOfNotification">
								{{ timeFormat(user.created_at) }}
							</div>
							<span class="font-weight-bold" id="notification"
								>{{ user.fullName }} Just create a new acount.You should view
								now</span
							>
						</div>
					</a>
					<a class="dropdown-item text-center small text-gray-500" href="#"
						>Show All Alerts</a
					>
				</div>
			</li>

			<!-- Nav Item - Messages -->
			<li class="nav-item dropdown no-arrow mx-1">
				<a
					class="nav-link dropdown-toggle"
					href="#"
					id="messagesDropdown"
					role="button"
					data-toggle="dropdown"
					aria-haspopup="true"
					aria-expanded="false"
				>
					<i class="fas fa-envelope fa-fw"></i>
					<!-- Counter - Messages -->
					<span class="badge badge-danger badge-counter">{{
						state.messageNotifications.length
					}}</span>
				</a>
				<!-- Dropdown - Messages -->
				<div
					class="
						dropdown-list dropdown-menu dropdown-menu-right
						shadow
						animated--grow-in
					"
					aria-labelledby="messagesDropdown"
				>
					<h6 class="dropdown-header">Message Center</h6>
					<a
						class="dropdown-item d-flex align-items-center"
						:href="`/admin/chat/${message.sender_id}/show`"
						v-for="(message, index) of state.messageNotifications"
						:key="index"
					>
						<div class="dropdown-list-image mr-3">
							<img
								class="rounded-circle"
								:src="`/storage/backend/images/${message.sender.photo}`"
								:alt="message.sender.photo"
							/>
							<div class="status-indicator bg-success"></div>
						</div>
						<div class="font-weight-bold">
							<div class="text-truncate">
								{{ message.message.messages }}
							</div>
							<div class="small text-gray-500">
								{{ message.sender.fullName }} -
								{{ moments(message.message.created_at) }}
							</div>
						</div>
					</a>
					<a class="dropdown-item text-center small text-gray-500" href="#"
						>Read More Messages</a
					>-
				</div>
			</li>

			<div class="topbar-divider d-none d-sm-block"></div>

			<!-- Nav Item - User Information -->
			<li class="nav-item dropdown no-arrow">
				<a
					class="nav-link dropdown-toggle"
					href="#"
					id="userDropdown"
					role="button"
					data-toggle="dropdown"
					aria-haspopup="true"
					aria-expanded="false"
				>
					<span class="mr-2 d-none d-lg-inline text-gray-600 small">{{
						state.user.fullName
					}}</span>
					<img
						class="img-profile rounded-circle"
						:src="`/storage/backend/images/${state.user.photo}`"
					/>
				</a>
				<!-- Dropdown - User Information -->
				<div
					class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
					aria-labelledby="userDropdown"
				>
					<a class="dropdown-item" href="/admin/user/my/profile">
						<i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
						Profile
					</a>
					<a class="dropdown-item" href="#">
						<i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
						Settings
					</a>
					<a class="dropdown-item" href="#">
						<i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
						Activity Log
					</a>
					<div class="dropdown-divider"></div>
					<a
						class="dropdown-item"
						href=""
						data-toggle="modal"
						data-target="#logoutModal"
					>
						<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
						Logout
					</a>
				</div>
			</li>
		</ul>
	</nav>
</template>

<script>
import { reactive, onMounted } from "vue";
import moment from "moment";
export default {
	props: ["messages", "auth"],
	setup(props) {
		const state = reactive({
			messageNotifications: [],
			alertNotifications: [],
			user: props.auth,
		});

		onMounted(() => {
			fetchNotification();
		});

		function fetchNotification() {
			props.messages.forEach((element) => {
				if (element.data.message)
					state.messageNotifications.push(element.data.message);
				if (element.data.user) state.alertNotifications.push(element.data.user);
				if (element.data.post) state.alertNotifications.push(element.data.post);
			});
			console.log(state.messageNotifications);
		}
		const moments = (time) => {
			return moment(time).calendar();
		};

		const timeFormat = (data) => {
			moment(data).calendar();
		};
		return { state, moments, timeFormat };
	},
};
</script>

<style></style>
