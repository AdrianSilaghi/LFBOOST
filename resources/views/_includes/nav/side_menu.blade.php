<nav class="navbar navbar-expand-md border-grey-light border-b border-t h-12  navbar-light bg-light" id="catNav">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      Categories <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
      <ul class="navbar-nav">
          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Fortnite
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                
              <a href="{{route('showSpecificCat','Fortnite')}}" class="dropdown-item m-t-10">All in Fortnite</a>
                <hr></hr>
                <a class="dropdown-item" href="{{route('showPostByCat',['Fortnite','Win Boost'])}}">Win Boost</a>
                <a class="dropdown-item" href="{{route('showPostByCat',['Fortnite','Challanges and Quests'])}}">Challanges and Quests</a>
                <a class="dropdown-item" href="{{route('showPostByCat',['Fortnite','Leveling'])}}">Leveling</a>
                <a class="dropdown-item" href="{{route('showPostByCat',['Fortnite','Coaching'])}}">Coaching</a>
              </div>
            </li>
          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                League of Legends
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                
                  
                <a href="{{route('showSpecificCat','League of Legends')}}" class="dropdown-item m-t-10">All in League of Legends</a>
                
                <hr>
                <a class="dropdown-item" href="{{route('showPostByCat',['League of Legends','Solo Queue Boost'])}}">Solo Queue Boost</a>
                <a class="dropdown-item" href="{{route('showPostByCat',['League of Legends','Duo Queue Boost'])}}">Duo Queue Boost</a>
                <a class="dropdown-item" href="{{route('showPostByCat',['League of Legends','Full Ranked Team'])}}">Full Ranked Team</a>
                <a href="{{route('showPostByCat',['League of Legends','Smurfs'])}}" class="dropdown-item">Smurfs</a>
              
              
              </div>
           </li>
          <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    World of Warcraft
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a href="{{route('showSpecificCat','World of Warcraft')}}" class="dropdown-item m-t-10">All in World of Warcraft</a>
                    <hr>
                  <a class="dropdown-item" href="{{route('showPostByCat',['World of Warcraft','Arena'])}}">Arena</a>
                  <a class="dropdown-item" href="{{route('showPostByCat',['World of Warcraft','Mythic+'])}}">Mythic+</a>
                  <a class="dropdown-item" href="{{route('showPostByCat',['World of Warcraft','RBG'])}}">RBG</a>
                  <a class="dropdown-item" href="{{route('showPostByCat',['World of Warcraft','Raids'])}}">PvE/Raids</a>
                  <a class="dropdown-item" href="{{route('showPostByCat',['World of Warcraft','Farming'])}}">Farming</a>
                  <a class="dropdown-item" href="{{route('showPostByCat',['World of Warcraft','Leveling'])}}">Leveling</a>
                  <a class="dropdown-item" href="{{route('showPostByCat',['World of Warcraft','Coaching'])}}">Coaching</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Overwatch
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <a href="{{route('showSpecificCat','Overwatch')}}" class="dropdown-item m-t-10">All in Overwatch</a>
                      <hr></hr>
                    <a class="dropdown-item" href="{{route('showPostByCat',['Overwatch','Solo Queue Boost'])}}">Solo Queue</a>
                    <a class="dropdown-item" href="{{route('showPostByCat',['Overwatch','Duo Queue Boost'])}}">Duo Queue</a>
                    <a class="dropdown-item" href="{{route('showPostByCat',['Overwatch','Leveling'])}}">Leveling</a>
                    <a class="dropdown-item" href="{{route('showPostByCat',['Overwatch','Coaching'])}}">Coaching</a>
                  </div>
              </li>
          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  CS:GO
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a href="{{route('showSpecificCat','CS:GO')}}" class="dropdown-item m-t-10">All in CS:GO</a>
                  <hr></hr>
                <a class="dropdown-item" href="{{route('showPostByCat',['CS:GO','Rank Boost'])}}">Rank Boost</a>
                <a class="dropdown-item" href="{{route('showPostByCat',['PUBG','Coaching'])}}">Coaching</a>
                <a class="dropdown-item" href="{{route('showPostByCat',['PUBG','Placement Matches'])}}">Placement Matches</a>

              </div>
            </li>
          <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    PUBG
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a href="{{route('showSpecificCat','PUBG')}}" class="dropdown-item m-t-10">All in PUBG</a>
                    <hr></hr>
                  <a class="dropdown-item" href="{{route('showPostByCat',['PUBG','Duo Boost'])}}">Duo Boost</a>
                  <a class="dropdown-item" href="{{route('showPostByCat',['PUBG','Squad Boost'])}}">Squad Boost</a>
                  <a class="dropdown-item" href="{{route('showPostByCat',['PUBG','Coaching'])}}">Coaching</a>
                </div>
              </li>
          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  DOTA
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a href="{{route('showSpecificCat','DOTA')}}" class="dropdown-item m-t-10">All in DOTA</a>
                  <hr></hr>
                <a class="dropdown-item" href="{{route('showPostByCat',['DOTA','MMR Boost'])}}">MMR Boost</a>
                <a class="dropdown-item" href="{{route('showPostByCat',['DOTA','Coaching'])}}">Coaching</a>
              </div>
            </li>
          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Rainbow Six Seige
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a href="{{route('showSpecificCat','Rainbow Six Seige')}}" class="dropdown-item m-t-10">All in Rainbow Six Seige</a>
                  <hr></hr>
                  <a class="dropdown-item" href="{{route('showPostByCat',['Rainbow Six Seige','Rank Boosting'])}}">Rank Boosting</a>
                  <a class="dropdown-item" href="{{route('showPostByCat',['Rainbow Six Seige','Placement Matches'])}}">Placement Matches</a>
                  <a class="dropdown-item" href="{{route('showPostByCat',['Rainbow Six Seige','Coaching'])}}">Coaching</a>
                  <a class="dropdown-item" href="{{route('showPostByCat',['Rainbow Six Seige','Wins'])}}">Wins</a>
              </div>
          </li>
          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Hearthstone
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a href="{{route('showSpecificCat','Hearthstone')}}" class="dropdown-item m-t-10">All in Hearthstone</a>
                  <hr></hr>
                  <a class="dropdown-item" href="{{route('showPostByCat',['Hearthstone','Coaching'])}}">Coaching</a>

              </div>
          </li>
      </ul>
    
  </div>
  </nav>
