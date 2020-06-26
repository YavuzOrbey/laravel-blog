
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
    <script>
      
    Vue.component('user-chat', {
      data: function(){
        return {
          users: null,
          selected: null,
          messages: {},
          minimized: true
        }
      },
      mounted(){
        this.getUsers();
      },
      methods: {
        getUsers(){
          axios.get(`/api/users`, {
              headers: {
              Authorization: 'Bearer ' + this.$parent.user.api_token //the token is a variable which holds the token
              }
          })
          .then((response) => {
            this.users = response.data;
          })
          .catch(function (error) {
            console.log(error);
          });
        },
      },
  template: `<div id="chat" >
    <div id='chat-navigation'>
      <div id='chat-minimize' class='chat-btn'>_</div>
      <div id='chat-close' class='chat-btn'>X</div>
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
            if(this.user){
              this.chat = true;
              this.listen();
            }
          },
          listen(){
            Echo.channel(`comments_${this.user.id}`).listen('NewComment', (comment)=> {this.notifications++;} )
          }

        }
      });


    

Vue.component('user-select', {
  props: ['users'],
  template: `<select id="user-select" v-model="selected"  v-on:change="run" >
      <option v-for="user in users" v-bind:value="user.id">@{{user.username}}</option>
    </select>`,
  data: function(){
    return {
      selected: null,
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
      Echo.channel(`private_message_${parseInt(first)}_${parseInt(second)}`).listen('.NewPrivateMessage', 
      (newMessage)=> this.$parent.messages.push(newMessage) );
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
      axios.get(`/api/messages/${this.selected}`, {
          headers: {
          Authorization: 'Bearer ' + this.$root.user.api_token //the token is a variable which holds the token
          }
      })
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
            api_token: this.$root.user.api_token,
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
        <button></button>
      </div>
    </div>`
})
</script>
<script>
  dragElement(document.getElementById("chat"));
    
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
  </script>
  </body>
</html>