<template>
	<div class="row">
		<div class="col-8">
			<div
				class="card direct-chat direct-chat-primary px-3"
				style="height: 550px !important"
			>
				<div class="card-header ui-sortable-handle">
					<h3 class="card-title justify-content-center">
						{{ state.reciever.fullName }}
					</h3>

					<div class="card-tools">
						<span
							data-toggle="tooltip"
							:title="`${state.unreadSms.length} New Messages`"
							class="badge badge-primary"
							>{{ state.unreadSms.length }}</span
						>

						<button
							type="button"
							class="btn btn-tool"
							data-toggle="tooltip"
							title="Contacts"
							data-widget="chat-pane-toggle"
						>
							<i class="fas fa-comments"></i>
						</button>
					</div>
				</div>
				<!-- /.card-header -->
				<div class="card-body border">
					<!-- Conversations are loaded here -->
					<div
						class="direct-chat-messages scroll"
						style="height: 438px !important"
					>
						<!-- Message to the right -->
						<div
							id="chat-list"
							class="direct-chat-msg"
							:class="state.authUser.id == chat.sender.id ? 'right' : ''"
							v-for="(chat, index) of state.chats"
							:key="index"
							v-show="
								chat.reciever.id == state.reciever.id ||
								chat.sender.id == state.reciever.id
							"
						>
							<div class="direct-chat-infos clearfix">
								<span
									class="direct-chat-name"
									:class="
										state.authUser.id == chat.sender.id
											? 'float-right'
											: 'float-left'
									"
									>{{ chat.sender.fullName }}</span
								>
								<span
									class="direct-chat-timestamp float-left"
									:class="
										state.authUser.id == chat.sender.id
											? 'float-left'
											: 'float-right'
									"
									>{{ timeFormat(chat.message.created_at) }}</span
								>
							</div>
							<!-- /.direct-chat-infos -->
							<img
								class="direct-chat-img"
								:src="'/storage/backend/images/' + chat.sender.photo"
								:alt="chat.sender.photo"
							/>
							<!-- /.direct-chat-img -->
							<div class="direct-chat-text">{{ chat.message.messages }}</div>
							<!-- /.direct-chat-text -->
						</div>
						<!-- /.direct-chat-msg -->
					</div>
					<!--/.direct-chat-messages-->

					<!-- Contacts are loaded here -->
					<div class="direct-chat-contacts">
						<ul class="contacts-list">
							<li v-for="(user, index) in state.allUsers" :key="index">
								<a :href="`/admin/chat/${user.id}/show`">
									<img
										class="contacts-list-img"
										style="height: 40px"
										:src="`/storage/backend/images/${user.photo}`"
									/>

									<div class="contacts-list-info">
										<span class="contacts-list-name">
											{{ user.fullName }}
											<small
												class="contacts-list-date float-right"
												v-for="(msg, i) of state.lastMessage"
												:key="i"
											>
												<span v-for="(message, i) of msg[user.id]" :key="i">{{
													timeFormat(message.create_at)
												}}</span>
											</small>
										</span>
										<span
											class="contacts-list-msg"
											v-for="(msg, i) of state.lastMessage"
											:key="i"
										>
											<span v-for="(message, i) of msg[user.id]" :key="i">{{
												message.messages
											}}</span>
										</span>
									</div>
									<!-- /.contacts-list-info -->
								</a>
							</li>
							<!-- End Contact Item -->
						</ul>
						<!-- /.contacts-list -->
					</div>
					<!-- /.direct-chat-pane -->
				</div>
				<!-- /.card-body -->
				<div class="card-footer">
					<form @submit.prevent="sendMessages()">
						<input type="hidden" id="data" value="2" />
						<div class="input-group">
							<input
								type="text"
								id="messages"
								placeholder="Type Message..."
								class="form-control"
								v-model="state.message"
								@keydown="typingEvent()"
							/>
							<span class="input-group-append">
								<button type="submit" id="sendMessages" class="btn btn-primary">
									Send
								</button>
							</span>
						</div>
					</form>
					<span class="text-sm text-info" v-if="state.typer"
						>{{ state.typer }} is typing ....</span
					>
				</div>
				<!-- /.card-footer-->
			</div>
		</div>
		<div class="col-4">
			<ActiveUser :authUser="state.authUser" />
		</div>
	</div>
	{{ state.alertNotify }}
</template>

<script>
import { onMounted, reactive, computed } from "vue";
import axios from "axios";
import ActiveUser from "./ActiveUser.vue";
import moment from "moment";

export default {
	components: { ActiveUser },
	props: ["reciever", "sender", "users", "messages"],
	setup(props) {
		const state = reactive({
			chats: [],
			authUser: props.sender,
			reciever: props.reciever,
			message: "",
			allUsers: props.users,
			lastMessage: [],
			alertNotify: "",
			typer: "",
			timer: "",
			unreadSms: props.messages,
		});
		onMounted(() => {
			fetchMessages();
			broadcastedMessage();
			scroller();
			fetchLastMessage();
			typerFinder();
		});

		function scroller() {
			$(".scroll").animate(
				{
					scrollTop: 100000 + $(".scroll").get(0).scrollHeight,
				},
				2000
			);
		}

		function fetchMessages() {
			console.log(state.unreadSms);
			axios
				.get(
					`/admin/chat/fetchMessages/${state.authUser.id}/${state.reciever.id}`
				)
				.then((e) => {
					e.data.forEach((el) => {
						state.chats.push(el);
					});
				});
		}

		function fetchLastMessage() {
			state.allUsers.forEach((user) => {
				axios
					.get(`/admin/chat/fetchLastMessage/${state.authUser.id}/${user.id}`)
					.then((res) => {
						state.lastMessage.push({
							[user.id]: Array(res.data.pop().message),
						});
					});
			});
		}

		function broadcastedMessage() {
			Echo.join(`chatting.channel.${state.authUser.id}`).listen(
				".chatting.event",
				(e) => {
					state.chats.push(e.data);
					scroller();
					notify();
				}
			);
		}

		const sendMessages = () => {
			if (state.message !== "") {
				axios
					.post("/admin/chat", {
						messages: state.message,
						reciever_id: state.reciever.id,
					})
					.then((result) => {
						state.chats.push(result.data);
						state.message = "";
						scroller();
					});
			}
		};

		const typingEvent = () => {
			Echo.join(
				`typer.finder.${state.authUser.id}.and.${state.reciever.id}`
			).whisper("typing", state.authUser);
		};

		function typerFinder() {
			Echo.join(
				`typer.finder.${state.reciever.id}.and.${state.authUser.id}`
			).listenForWhisper("typing", (user) => {
				clearTimeout(state.timer);
				state.typer = user.fullName;
				state.timer = setTimeout(function () {
					state.typer = false;
				}, 3000);
			});
		}

		const notify = () => {};

		const timeFormat = ($data) => {
			return moment($data).calendar();
		};

		return { state, sendMessages, timeFormat, typingEvent };
	},
};
</script>

<style></style>
