<template>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card" v-for="message in messages">
                <div class="card-header">
                    <strong>
                        {{message.user.name}}
                    </strong>
                </div>
                <div class="card-body">
                <p>{{message.message}}</p>
                </div>
            </div>
        </div>
    </div>
</div>

</template>

<script>
    export default {
        props: ['messages'],
        mounted() {
            console.log(this.message);
        }
    }
</script>