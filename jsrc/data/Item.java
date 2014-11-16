package cpsc304.src.data;

public class Item
{
	
	private int upc;
	private String title;
	private String type;
	private String category;
	private String company;
	private int year;
	private int price;
	private int stock;

	public Item (int upc, String title, String type, String category, String company, int year, int price, int stock)
	{
		this.upc = upc;
		this.title = title;
		this.type = type;
		this.category = category;
		this.company = company;
		this.year = year;
		this.price = price;
		this.stock = stock;
	}

	public int getUpc(){
		return this.upc;
	}
	
	public void setUpc(int upc){
		this.upc = upc;
	}
	
	public String getTitle(){
		return this.title;
	}

	public void setTitle(String title){
		this.title = title;
	}

	public String getType(){
		return this.type;
	}

	public void setType(String type){
		this.type = type;
	}

	public String getCateory(){
		return this.category;
	}

	public void setCategory(String category){
		this.category = category;
	}

	public String getCompany(){
		return this.company;
	}

	public void setCompany(String company){
		this.company = company;
	}

	public int getYear(){
		return this.year;
	}

	public void setYear(int year){
		this.year = year;
	}

	public int getPrice(){
		return this.price;
	}

	public void setPrice(int price){
		this.price = price;
	}
	
	public int getStock(){
		return this.stock;
	}

	public void setStock(int stock){
		this.stock = stock;
	}
}	
