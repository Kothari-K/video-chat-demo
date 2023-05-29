require('./bootstrap');

import { createApp } from 'vue';
import videoChat from  './components/VideoChat.vue';
import { library } from '@fortawesome/fontawesome-svg-core'
import { faHatWizard } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import drag from "v-drag"


let app=createApp({})
app.component('videoChat' , videoChat);
app.component('font-awesome-icon', FontAwesomeIcon);

app.use(drag, {
  // global configuration
}).mount("#app")
