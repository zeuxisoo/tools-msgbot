<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>MsgBot</title>
<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/vue"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<style>
body {
    font-family: 'Noto Sans', sans-serif;
    padding-top: 30px;
}
</style>
</head>
<body>
<div id="app">
    <div class="container">
        <div class="card">
            <div class="card-header">TgBot</div>
            <div class="card-body">
                <div class="form">
                    <div class="form-group row">
                        <label for="chat-id" class="col-sm-2 col-form-label">Chat Id</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="chat-id" v-model="chatId">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="message" class="col-sm-2 col-form-label">Message</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="5" id="message" v-model="message"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="message" class="col-sm-2 col-form-label">&nbsp;</label>
                        <div class="col-sm-10">
                            <button type="button" class="btn btn-primary" v-on:click="sendMessage">Send</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="alert.show">
            <hr>

            <div class="alert"
                role="alert"
                v-bind:class="{
                    'alert-success': alert.ok,
                    'alert-danger' : !alert.ok
                }">
                {{alert.message}}
            </div>
        </div>
    </div>
</div>
<script>
(function() {

    const getApiURL = action => `api.php?action=${action}`;

    const app = new Vue({
        el: '#app',

        data() {
            return {
                chatId : "",
                message: "",

                alert: {
                    show   : false,
                    ok     : true,
                    message: ""
                }
            }
        },

        methods: {
            sendMessage() {
                axios
                    .post(getApiURL('send-message'), {
                        chatId : this.chatId,
                        message: this.message,
                    })
                    .then(response => {
                        const data = response.data;

                        this.alert.show    = true;
                        this.alert.ok      = data.ok;
                        this.alert.message = data.message;

                        setTimeout(() => {
                            this.alert.show = false
                        }, 2000);
                    })
                    .catch(error => {
                        alert('Cannot send message, Got unknown error');
                    });
            }
        }
    });

})(Vue);
</script>
</body>
</html>
