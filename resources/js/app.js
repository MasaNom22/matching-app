import './bootstrap'
import Vue from 'vue'
import ArticleLike from './components/ArticleLike'
import FollowButton from './components/FollowButton'
import UserTagsInput from './components/UserTagsInput'

const app = new Vue({
  el: '#app',
  components: {
    ArticleLike,
    FollowButton,
    UserTagsInput,
  }
})



