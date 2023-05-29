<template>
  <div class="container">
    <h1 class="text-center">Connect Video Chat With Dragabble Window</h1>   
    <div class="row g-0 h-100">
        <div class="col-md-3 left">
            <ul  v-for="(name,userId) in others" :key="userId">
              <li>
                  <button @click="startVideoChat(userId)" class="btn btn-success" v-text="`Connect with ${name}`"/>
              </li>
            </ul>
        </div>
    </div>

    <div class="video-container" ref="video-container" id="console" v-drag>
      <video class="video-here" ref="video-here" autoplay ></video>  
      <video class="video-there" ref="video-there" autoplay></video>
       <div v-if="auth_user != ''" class="btn-area">    
          <button @click="leaveChat()" title="Leave" class="btn btn-danger ml-1">
                   <i class="fas fa-solid fa-route"></i></button>
          <button @click="audioMute()" value="Leave" class="btn btn-primary ml-1" v-if=" mute == false" title="Mute"><i class="fas fa-microphone"></i></button>
          <button @click="audioUnMute()" value="Leave" class="btn btn-danger ml-1" title="UnMute" v-if=" mute == true"><i class="fas fa-microphone-slash"></i></button>
          <button @click="videoMute()" title="Mute" value="Leave" class="btn btn-primary ml-1" v-if=" v_mute == false"><i class="fas fa-video"></i></button>
          <button @click="videoUnMute()" title="UnMute" class="btn btn-danger ml-1" value="Leave" v-if=" v_mute == true"><i class="fas fa-video-slash"></i></button>
      </div>
    </div>
   
  </div>
</template>
<script>
import Pusher from 'pusher-js';
import Peer from 'simple-peer';
import drag from "v-drag"
export default {
  props: ['user', 'others', 'pusherKey', 'pusherCluster'],
  data() {
    return {
      channel: null,
      stream: null,
      peers: {},
      auth_user:'',
      mute:false,
      v_mute:false,
    }
  },
  mounted() {
    this.setupVideoChat(); 
    const drag = require("v-drag"); 
  },
  methods: {
    startVideoChat(userId) {
      this.getPeer(userId, true);
    },
    getPeer(userId, initiator) {
      
      this.auth_user = userId
      if(this.peers[userId] === undefined) {
        let peer = new Peer({
          initiator,
          stream: this.stream,
          trickle: false
        });
        peer.on('signal', (data) => {
          this.channel.trigger(`client-signal-${userId}`, {
            userId: this.user.id,
            data: data,
            leave:false,
          });
        })
        .on('stream', (stream) => {
         
          const videoThere = this.$refs['video-there'];
          videoThere.srcObject = stream;
        })
        .on('close', () => {
         
          const peer = this.peers[userId];
          if(peer !== undefined) {
            peer.destroy();            
          }
           this.channel.trigger(`client-signal-${userId}`, {
                userId: this.user.id,
                leave:true,
              });
          delete this.peers[userId];
        })
        .on('error', (err) => {
          console.log(err.code)
        });
        this.peers[userId] = peer;
       
      } 
      return this.peers[userId];
    },
    async setupVideoChat() {
      // To show pusher errors
       //Pusher.logToConsole = true;
      
      const stream = await navigator.mediaDevices.getUserMedia({ video: false, audio: true });
      // const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
      const videoHere = this.$refs['video-here'];
      videoHere.srcObject = stream;
      this.stream = stream;
      const pusher = this.getPusherInstance();
      this.channel = pusher.subscribe('presence-video-chat');
      this.channel.bind(`client-signal-${this.user.id}`, (signal) => 
      {
        if(!signal.leave){          
            const peer = this.getPeer(signal.userId, false);
            peer.signal(signal.data);
        }else if(signal.leave){
          const peer = this.peers[this.auth_user];                 
          if(peer !== undefined) {           
            peer.destroy();           
          }
          delete this.peers[this.auth_user];
        }
       
      });

    },
    getPusherInstance() {
      return new Pusher(this.pusherKey, {
        authEndpoint: '/auth/video_chat',
        cluster: this.pusherCluster,
        auth: {
          headers: {
            'X-CSRF-Token': document.head.querySelector('meta[name="csrf-token"]').content
          }
        }
      });
    },
    leaveChat(){
     
       const peer = this.peers[this.auth_user];                 
        if(peer !== undefined) {           
          peer.destroy();           
        }
        delete this.peers[this.auth_user];
    },
    audioMute(){
      this.stream.getAudioTracks()[0].enabled = false;
      this.mute = true
      
    },
    audioUnMute(){
        this.stream.getAudioTracks()[0].enabled = true;
        this.mute = false
    },
    videoMute(){
       this.stream.getVideoTracks()[0].enabled = false;
       this.v_mute = true
    },
    videoUnMute(){
       this.stream.getVideoTracks()[0].enabled = true;
       this.v_mute = false
    }
  }
};
</script>
<style>
    .video-container {
        width: 500px;
        height: 380px;
        margin: 8px auto;
        border: 3px solid #000;
        position: relative;
        box-shadow: 1px 1px 1px #9e9e9e;
    }
    .video-here {
        width: 130px;
        position: absolute;
        left: 10px;
        bottom: 16px;
        border: 1px solid #000;
        border-radius: 2px;
        z-index: 2;
    }
    .video-there {
        width: 100%;
        height: 100%;
        z-index: 1;
    }
    .btn-area button{
      margin-left: 8px;
    }

</style>