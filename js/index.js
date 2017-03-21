window.onload = function() {
	var request = new XMLHttpRequest();
	request.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var obj = JSON.parse(this.responseText);
			outputData(obj);
		}
	};
	request.open("GET", "json/books_list.php", true);
	request.send();
}

function outputData(list) {
	createJumbotron(list[0]);
	for (var i = 0; i < list.length; i++) {
		createBooks(list[i]);
	}
}

function createBooks(oneBook) {
        //Create a div for one book
	var div_element = document.createElement("div");
	div_element.className = 'col-sm-6 col-md-4';
	var div_thumbnail = document.createElement("div");
	div_thumbnail.className = 'thumbnail';
	var image = document.createElement("img");
	image.src = oneBook.image;
	div_thumbnail.appendChild(image);
	var div_caption = document.createElement("div");
	div_caption.className = 'caption';
	var label = document.createElement("h3");
	label.appendChild(document.createTextNode(oneBook.title));
	div_caption.appendChild(label);
	div_thumbnail.appendChild(div_caption);
	div_element.appendChild(div_thumbnail);
	div_thumbnail.onclick = function() {
		createJumbotron(oneBook);
		window.scrollTo(0,0);
	}
	document.getElementById("demo").appendChild(div_element);
}

function createJumbotron(book) {
	var jumbotronTextArea = document.getElementById("jumbotron_textarea")
	while (jumbotronTextArea.hasChildNodes()) {
		jumbotronTextArea.removeChild(jumbotronTextArea.firstChild);
	}
	document.getElementById("jumbotron_cover").src = book.image;
	var title_elem = document.createElement("h2");
	title_elem.appendChild(document.createTextNode(book.title));
	var desc_elem = document.createElement("p");
	desc_elem.appendChild(document.createTextNode(book.description));
	document.getElementById("jumbotron_textarea").appendChild(title_elem);
	document.getElementById("jumbotron_textarea").appendChild(desc_elem);
    document.getElementById("book_id").value = book.id;
    document.getElementById("book_title").value = book.title;
}