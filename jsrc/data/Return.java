package cpsc304.src.data;

import java.math.BigInteger;
import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.Random;

public class Return {
private String retID;
private String return_date;
private String receiptID;
private String store_name;

//Constructor:
public Return(String purchase_receiptID, String sname){
	//Generate a retID
	BigInteger rand = new BigInteger(33, new Random());
	this.retID =  rand.toString();
	
	//Get current date
	DateFormat dateFormat = new SimpleDateFormat("yyyy-mm-dd");
	Date date = new Date();
	this.return_date = (dateFormat.format(date)).toString();
	
	this.receiptID = purchase_receiptID;	
	this.store_name = sname;
}

// Getters:
public String getRetID(){
	return this.retID;
}
public String getReturnDate(){
	return this.return_date;
}
public String getReturnReceiptID(){
	return this.receiptID;
}
public String getReturnStoreName(){
	return this.store_name;
}

//Setters:
public void setRetID(String id){
	this.retID = id;
}
public void setReturnDate(String date){
	this.return_date = date;
}
public void setReturnReceiptID(String id){
	this.receiptID = id;
}
public void setReturnStoreName(String name){
	this.store_name = name;
}


}
