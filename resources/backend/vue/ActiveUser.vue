<template>
  <div class="card direct-chat direct-chat-primary px-3" style="height: 550px !important">
    <div class="card-header ui-sortable-handle" style="cursor: move">
      <h3 class="card-title justify-content-center">Active Users</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body border">
      <!-- Conversations are loaded here -->
      <div class="direct-chat-messages pb-2" style="height: 486px !important">
        <!-- Message to the right -->
        <div
          id="chat-list"
          class="direct-chat-msg"
          v-for="(user, index) of state.activeUsers"
          :key="index"
          v-show="state.authUser.id != user.id"
        >
          <a
            class="dropdown-item d-flex align-items-center"
            :href="state.authUser.id == user.id ? '#' : `/admin/chat/${user.id}/show`"
          >
            <div class="dropdown-list-image mr-3">
              <img
                class="rounded-circle"
                style="width: 40px; height: 40px"
                :src="`/storage/backend/images/${user.photo}`"
                :alt="user.photo"
              />
              <div class="status-indicator bg-success"></div>
            </div>
            <div class="font-weight-bold">
              <div class="text-truncate">{{ user.fullName }}</div>
              <div class="small text-success">Active</div>
            </div>
          </a>
        </div>
        <!-- /.direct-chat-msg -->
      </div>
      <!--/.direct-chat-messages-->
    </div>
    <!-- /.card-body -->
    <div class="card-footer py-2"></div>
  </div>
</template>

<script>
import { reactive, onMounted } from "vue";
export default {
  props: ["authUser"],
  setup(props) {
    const state = reactive({
      activeUsers: [],
      authUser: props.authUser,
    });

    onMounted(() => {
      activeUsers();
    });

    function activeUsers() {
      Echo.join("active.user.checker")
        .here((users) => {
          users.forEach((el) => {
            state.activeUsers.push(el);
          });
        })
        .joining((user) => {
          state.activeUsers.push(user);
        })
        .leaving((user) => {
          state.activeUsers = state.activeUsers.filter((u) => {
            return u.id != user.id;
          });
        });
    }
    return { state };
  },
};
</script>

<style></style>
