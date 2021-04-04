import './bootstrap'
import Vue from 'vue'
import ArticleLike from './components/ArticleLike'
import FollowButton from './components/FollowButton'


const app = new Vue({
  el: '#app',
  components: {
    ArticleLike,
    FollowButton,
  }
})

const chat = new Vue({
            el: '#chat',
            data: {
                message: '',
                messages: []
            },
            methods: {
                getMessages() {

                    const url = '/ajax/chat';
                    axios.get(url)
                        .then((response) => {

                            this.messages = response.data;

                        });

                },
                send() {

                    const url = '/ajax/chat';
                    const params = { message: this.message };
                    axios.post(url, params)
                        .then((response) => {

                            // 成功したらメッセージをクリア
                            this.message = '';

                        });

                }
            },
            mounted() {

                this.getMessages();

                Echo.channel('chat')
                    .listen('MessageCreated', (e) => {

                        this.getMessages(); // メッセージを再読込

                    });

            }
        });

