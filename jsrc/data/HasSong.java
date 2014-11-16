package cpsc304.src.data;

public class HasSong {
private String upc;
private String title;

//Constructor:
public HasSong(String upc, String title){

	this.upc = upc;	
	this.title = title;
}

// Getters:
public String getUpc(){
	return this.upc;
}
public String getTitle(){
	return this.title;
}

//Setters:
public void setUpc(String upc){
	this.upc = upc;
}
public void setTitle(String title){
	this.title = title;
}


}