<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Center Image</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('vcard/style.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.0/FileSaver.min.js"></script>
  </head>
  <body>
      <div class="card-container" onclick="flipCard(this)">
        <div class="card">
          <div class="card-front" id="imagesave">
            <div class="card-content">
              <div class="card-logo">
                <img src="{{ asset('vcard/logo.png') }}" class="front-image" alt="Front of the card" width="120px" height="120px">
                <span>Moving Ahead To Serve You Better</span>
              </div>
            </div>
            <div class="card-description">
              <span>{{ $card->fullname }}</span>
              @if (!empty($card->managing))
              <span>{{ $card->managing }}</span>
              @endif
              <span>{{ $card->position }}</span>
              </br>
              <span>Cel {{ $card->formatted_contact_number }}</span>
              <span>Fax 02 8553 8216</span>
              <span>{{ $card->email }}</span>
              <span>www.arvinintl.com</span>
              </br>
              <span>18th Floor, Y Tower Bldg. Blk 4, Lot 1</span>
              <span>corner Coral Way Street, Macapagal</span>
              <span>Avenue, Mall of Asia Complex Pasay City</span>
              <span>1300, Philippines</span>
              <span>02 8843 3676 to 80 | 02 8869 1655</span>
              <span>02 8815 0469 to 70</span>
            </div>
          </div>
          <div class="card-back">
            <img src="{{ asset('vcard/back.png') }}"  class="back-image" alt="Back of the card">
          </div>
        </div>
      </div>

      <div class="icons">
        <div class="plus-icon"  id="save-contact">
          <i class="fa-solid fa-plus"></i>
        </div>
  
        <div class="image-icon" id="save-image">
          <i class="fa-solid fa-image"></i>
        </div>
      </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js" integrity="sha512-u3fPA7V8qQmhBPNT5quvaXVa1mnnLSXUep5PS1qo5NRzHwG19aHmNJnj1Q8hpA/nBWZtZD4r4AX6YOt5ynLN2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
      function flipCard(element) {
        element.classList.toggle('flipped');
      }

      $( "#save-image" ).on( "click", function() {
        html2canvas(document.querySelector("#imagesave")).then(canvas => {
          canvas.toBlob(function(blob) {
            window.saveAs(blob, 'my_image.jpg');
          });
          });
      });

      var saveBtn = document.getElementById("save-contact");
        saveBtn.addEventListener("click", function () {
          // Get the contact information from the website
          var contact = {
              fullname: "{{ $card->fullname }}- ARVIN",
              fname: "{{ $card->fname }} - ARVIN",
              lname: "{{ $card->lname }}",
              phone: "{{ $card->contact }}",
              position: "{{ $card->position }}",
              company: "ARVIN INT'L MRKTG INC.",
              email: "{{ $card->email }}"
          };

          // create a vcard file
          var vcard = `BEGIN:VCARD
                    VERSION:3.0
                    N;CHARSET=utf-8:${contact.lname};${contact.fname};;;
                    FN;CHARSET=utf-8:${contact.fullname}
                    TEL;TYPE=WORK,VOICE:${contact.phone}
                    TITLE;CHARSET=utf-8:${contact.position}
                    ORG:${contact.company}
                    EMAIL;INTERNET:${contact.email}
                    END:VCARD`;

          var blob = new Blob([vcard], { type: "text/vcard" });
          var url = URL.createObjectURL(blob);
          
          const newLink = document.createElement('a');
          newLink.download = contact.fullname + ".vcf";
          newLink.textContent = contact.fullname;
          newLink.href = url;
          
          newLink.click();
        });
    </script>
  </body>
</html>
