<template>


        <div class="card-body" v-if="chats.length != 0">

            <div class="" v-for="chat in chats">
                    <div v-if="chat.user_id == userid">
                  <div class="card float-right m-t-10 m-b-10" style="width:500px;">
                    <div class="card-header">
                    <p class="text-muted float-left">
                    Me
                    </p>
                    </div>
                    <div class="card-body">
                   <p class="float-left"> {{chat.chat}} </p>
                    </div>
                    </div>
                </div>
                   
                <div v-else>
                    <div class="card float-left m-t-10 m-b-10" style="width:500px;"> 
                    <div class="card-header">
                    <p class="text-muted float-right">
                    Him
                    </p>
                    </div>
                    <div class="card-body">
                    <p class="float-left">{{chat.chat}} </p>
                    </div>
                    </div>
                </div>    
            </div>
            <chat-composer v-bind:userid="userid" v-bind:chats="chats" v-bind:contactid="contactid"></chat-composer>
        </div>  
        
</template>

<script>
    export default {
       props:['chats','userid','contactid']
    }
</script>