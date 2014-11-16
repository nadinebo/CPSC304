package cpsc304.src.data;

public class PurchaseItem
{
	private int receiptID;
	private int upc;
	private String quantity;

	//Constructor
	public Customer(int receiptID, int upc, String quantity) {
		this.receiptID = receiptID;
		this.upc = upc;
		this.quantity = quantity;
	}


	//for getters/setters of foreign keys, is it best to get them from their respective classes?
	public int getReceiptID() {
		return this.receiptID;
	}

	public void setReceiptID(int receiptID) {
		this.receiptID = receiptID;
	}

	public int getUpc() {
		return this.upc;
	}

	public void setUpc(String upc) {
		this.upc = upc;
	}

	public String getQuantity() {
		return this.quantity;
	}

	public void setQuantity(String quantity) {
		this.quantity = quantity;
	}

}