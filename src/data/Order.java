package cpsc304.src.data;

import java.math.BigInteger;
import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.Random;
import java.util.GregorianCalendar;

public class Order {
private String receiptID;
private String date;
private String cid;
private String cardNum;
private String expiry;
private String expectedDate;
private String deliveredDate;

//Constructor:
public Order(String receipt_ID, String cust_id){

	//Generate a receiptID for the order
	BigInteger rand = new BigInteger(33, new Random());
	this.receipt_ID =  rand.toString();
	
	//Get current date for the order
	DateFormat dateFormat = new SimpleDateFormat("yyyy-mm-dd");
	Date date = new Date();
	this.date = (dateFormat.format(date)).toString();

	//Set the expected delivery date (2 weeks)
	GregorianCalendar cal = new GregorianCalendar();
        cal.setTime(this.date);
        cal.add(Calendar.DATE, 14);
        this.expectedDate = cal.getTime();
	
	this.receiptID = receipt_ID;	
	this.cid = cust_id;
}

// Getters:
public String getReceiptID(){
	return this.receiptID;
}
public String getDate(){
	return this.date;
}
public String getCid(){
	return this.cid;
}
public String getCardNum(){
	return this.cardNum;
}
public String getExpiry(){
	return this.expiry;
}
public String getExpectedDate(){
	return this.expectedDate;
}
public String getDeliveredDate(){
	return this.deliveredDate;
}


//Setters:
public void setReceiptID(String id){
	this.receiptID = id;
}
public void setDate(String date){
	this.date = date;
}
public void setCID(String cid){
	this.cid = cid;
}
public void setCardNum(String cardNum){
	this.cardNum = cardNum;
}
public void setExpiry(String exp){
	this.expiry = exp;
}
public void setExpectedDate(String date){
	this.expectedDate = date;
}
public void setDeliveredDate(String date){
	this.deliveredDate = date;
}



}