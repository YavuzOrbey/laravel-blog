
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
    <script>
    const app = new Vue({
        el: '#app',
        data:  {
          user: {!! Auth::check() ? Auth::user()->toJson() : 'null' !!},
          notifications: 0,
          chat: false,
        },
        mounted(){
          this.run();
        },
        methods:{
          run(){
            let openChat = document.getElementById('open-chat');
            openChat.addEventListener('click', ()=>{
              this.chat=true
            })
            if(this.user){
              this.listen();
            }
          },

          listen(){
            Echo.channel(`comments_${this.user.id}`).listen('NewComment', (comment)=> {
              this.notifications++;} )
          },
          

        }
      });

    Vue.component('user-chat', {
      data: function(){
        return {
          users: [],
          selected: null,
          messages: {},
          minimized: true
        }
      },
      mounted(){
        this.startDraggable();
        this.getUsers();
      },
      methods: {
        getUsers(){
          axios.get(`/api/users`)
          .then((response) => {
            this.users = this.users.concat(response.data);
          })
          .catch(function (error) {
            console.log(error);
          });
        },
        startDraggable(){
            if(document.getElementById("chat")) dragElement(document.getElementById("chat"));
            
            function dragElement(elmnt) {
              var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
              if (document.getElementById(elmnt.id + "-navigation")) {
                
                // if present, the header is where you move the DIV from:
                document.getElementById(elmnt.id + "-navigation").onmousedown = dragMouseDown;
              }
              
              function dragMouseDown(e) {
                e = e || window.event;
                e.preventDefault();
              // get the mouse cursor position at startup:
              pos3 = e.clientX;
              pos4 = e.clientY;
              document.onmouseup = closeDragElement;
              // call a function whenever the cursor moves:
              document.onmousemove = elementDrag;
              }
  
              function elementDrag(e) {
                e = e || window.event;
                e.preventDefault();
                // calculate the new cursor position:
                pos1 = pos3 - e.clientX;
                pos2 = pos4 - e.clientY;
                pos3 = e.clientX;
                pos4 = e.clientY;
                // set the element's new position:
                elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
                elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
              }
  
              function closeDragElement() {
                // stop moving when mouse button is released:
                document.onmouseup = null;
                document.onmousemove = null;
              }
            }
          },
        closeChat(){
          document.getElementById('chat').style.display = 'none'
        }
      },
  template: `<div id="chat" >
    <div id='chat-navigation'>
      <div id='chat-minimize' class='chat-btn'>_</div>
      <div id='chat-close' class='chat-btn' v-on:click="closeChat">X</div>
    </div>
    <div class='chat-main'>
      <div id='left-chat-main'>
        <div id="profiles">
          <a v-bind:href="'/blog/'+ this.$parent.user.username"><img class="chat-profile" v-bind:src="'https://www.gravatar.com/avatar/'+this.$parent.user.avatar"></a>
          <img class="chat-profile" v-bind:src="'https://www.gravatar.com/avatar/'+this.selected"></div>
        <div id="buddies">
          <user-select :users="users" v-on:select="selected = $event"></user-select>
        </div>
      </div>
      <div id="right-chat-main">
        <messages :key="selected" :selected="selected" v-if="selected"></messages>
        <input-control :selected="selected"></input-control></div>
      </div>
    </div>
  `
});





    

Vue.component('user-select', {
  props: ['users'],
  template: `<select id="user-select" v-model="selected"  v-on:change="run" >
    <option disabled selected value=0>Choose User</option>
      <option v-for="user in users" v-bind:value="user.id">@{{user.username}}</option>
    </select>`,
  data: function(){
    return {
      selected: 0,
    }
  },  methods: {
    run(){
      this.listen();
      this.$emit('select', this.selected);
    },
    listen(){
      let first, second;
      if(this.$root.user.id <  this.selected){
        first = this.$root.user.id; 
        second=this.selected;
      }
      else{
        first = this.selected; 
        second=this.$root.user.id;
      }
      Echo.private(`message-${parseInt(first)}-${parseInt(second)}`).listen('.NewPrivateMessage', 
      (newMessage)=> {
        console.log('echo received something back from pusher');
        this.$parent.messages.push(newMessage);
      });
    }
  }
});

Vue.component('messages', {
  props: ['selected'],
  mounted(){
    this.getMessages();
  },
  methods: {
    getMessages() {
      axios.get(`/api/messages/${this.selected}`)
      .then((response) => {
        this.$parent.messages = response.data
      })
      .catch(function (error) {
        console.log(error);
      });
    },
  },
  template: `<div id="messages">
      <ul>
        <li  v-for="message in this.$parent.messages">
        <span v-bind:class="message.from===$root.user.username ? 'me': 'you'">@{{message.from}} (@{{message.created_at}}):</span>  @{{message.text}}
        </li>
      </ul>
      </div>`
});

Vue.component('input-control', {
  props: ['selected'],
  data: function(){
    return {
      messageBox:'',
    }
},
  methods: {
    sendMessage() {
        axios.post(`/api/messages/${this.selected}`, {
            body: this.messageBox
        })
        .then((response) => {
            this.$parent.messages.push(response.data);
            this.messageBox = '';
        })
        .catch((error) => {
            console.log(error);
        })
    },
  },
  template: `<div class='chat-input-control'>
      <div class='text-input'>
      <textarea name="body" v-model="messageBox" ></textarea>
      </div>
      <div class='chat-buttons'>
        <button id='send' @click.prevent="sendMessage" >SEND</button>
      </div>
    </div>`
})
</script>

<script>

  </script>

  </body>
</html>