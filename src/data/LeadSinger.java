package cpsc304.src.data;

public class LeadSinger
{
	private int upc;
	private String name;

	public LeadSinger(int upc, String name)
	{
		this.upc = upc;
		this.name = name;
	}

	public int getUpc(){
		return this.upc;
	}

	public void setUpc(int upc){
		this.upc = upc;
	}

	public String getName(){
		return this.name;
	}

	public void setName(String name){
		this.name = name;
	}
}
