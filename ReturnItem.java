//package ...;

public class ReturnItem {
	private String retID;
	private String upc;
	private int return_quantity;

	//Constructor:
	public ReturnItem(String item_upc, String return_retID, int ret_qty){
		this.retID = return_retID;
		this.upc = item_upc;
		this.return_quantity = ret_qty;
	}

	// Getters:
	public String getReturnItemRetID(){
		return this.retID;
	}
	public String getReturnItemUPC(){
		return this.upc;
	}
	public int getReturnItemQuantity(){
		return this.return_quantity;
	}

	//Setters:
	public void setReturnItemRetID(String id){
		this.retID = id;
	}
	public void setReturnItemUPC(String item_upc){
		this.upc = item_upc;
	}
	public void setReturnItemQuantity(int qty){
		this.return_quantity = qty;
	}

}
