<template>
    
    <div class="btn-group dropleft">
  <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Notifications {{ notifications.length }}
  </button>
  <div class="dropdown-menu">
    <li v-for="notification in notifications">
        <a class="dropdown-item" href="#" v-on:click="MarkAsRead(notification)">
        You have a new order!<br>
                    <small></small>
        </a>
    </li>
    <li v-if="notifications.length == 0">
                <a href=" " class="dropdown-item">
                You have no notifications
                    
                </a>
            </li>
  </div>
</div>
</template>

<script>
    export default {
        props: ['notifications'],
        methods: {
            MarkAsRead: function(notification) {
                var data = {
                    id: notification.id
                };
                axios.post('/notification/api/read', data).then(response => {
                    location.reload(false);
                });
            }
        }
    }
</script>