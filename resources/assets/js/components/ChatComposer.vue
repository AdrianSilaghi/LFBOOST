<template>
     <div class="card-body">

                <input class="form-control m-b-10 float-left" type="text" v-on:keyup.enter="sendChat" v-model="chat" style="width:85%;">
                <button class="btn btn-primary float-right" type="button" v-model="chat" v-on:click="sendChat">Send</button>
           
    </div>

</template>

<script>
    export default{
        props: ['userid','chats','contactid'],
        data() {
            return {
                chat:'',
            }
        },
            methods: {
                sendChat: function(e) {
                    if(this.chat != '') {
                        var data = {
                            chat: this.chat,
                            contact_id: this.contactid,
                            user_id:this.userid
                        }
                        this.chat = '';

                    axios.post('/dahsboard/inbox/sendChat', data).then((response)=>{
                        this.chats.push(data);
                    })
                    }
                }
            }
        
    }
</script>