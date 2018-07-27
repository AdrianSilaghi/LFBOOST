<template>
    
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-footer">
                    <form @submit.prevent.keyup="sent">
                        <div class="form-group">
                            <input type="text" v-model="message.message" class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Sent</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        props:['user'],
        data(){
            return {
                message: {
                    message:'',
                    user:this.user
                }
            }
        },
            methods: {
                sent() {
                    this.$emit('messagesent',this.message)
                    this.message = {}
                }
            }
        
    }
</script>