<template>

    <div class="btn-group dropleft ">
        <button type="button" class="btn btn-outline-success btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="far fa-bell m-r-5"></i>{{ notifications.length }}
        </button>
        <div class="dropdown-menu">
            <div class="text-center" v-if="notifications.length > 0">
            <button class="bg-green hover:bg-green-dark text-white py-1 px-2 rounded" v-on:click="MarkAllAsRead(notifications)">Clear all</button>
            </div>
                <li v-for="notification in notifications">

                <a class="dropdown-item" href="#" v-on:click="MarkAsRead(notification)">

                    <div v-if="notification.type.includes('NotifyChat')" v-on:click="GoToChat(notification)">
                        <p>You have a new message from {{notification.data.user.name}}</p>
                        <small class="form-text text-muted">Please check your inbox.</small>
                    </div>
                    <div v-if="notification.type.includes('NotifyPostOwner')" v-on:click="GoToPosts(notification)">
                        <p>{{notification.data.message}}</p>
                        <small class="form-text text-muted">Please check your posts.</small>
                    </div>
                    <div v-if="notification.type.includes('NotifyOrderOwner')" v-on:click="GoToOrder(notification)">
                        <p>You have a new order!</p>
                        <small class="form-text text-muted">Please check your Orders.</small>
                    </div>
                </a>
            </li>
            <li v-if="notifications.length == 0">
                <a class="dropdown-item">
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

                });
            },
            GoToOrder: function(notification){
                var data = {
                    transaction_id:notification.data.order.transaction_id
                };
                window.location.href = window.location.origin + '/dashboard/order?orderID=' + data.transaction_id;
            },
            GoToPosts: function (notification) {
                window.location.href = window.location.origin + '/dashboard/boosts';
            },
            GoToChat: function (notification) {
                var data = {
                    id: notification.data.user.id
                }
                window.location.href = window.location.origin + '/dashboard/inbox/' + data.id;
            },
            MarkAllAsRead: function(notifications)
            {


                  for(var i = 0;i< notifications.length; i++)
                  {
                      var notification = notifications[i];
                      var data = {
                          id: notification.id
                      };
                      axios.post('/notification/api/read', data).then(response => {

                      });
                      location.reload();
                  }

            }
        }
    }
</script>