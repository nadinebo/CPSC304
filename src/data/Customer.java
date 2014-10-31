package cpsc304.src.data;

public class Customer
{
	private int cid;
	private String passowrd;
	private String name;
	private String address;
	private String phone;

	// Constructor
	public Customer(int cid, String password, String name, String address, String phone) {
		this.cid = cid;
		this.password = password;
		this.name = name;
		this.address = address;
		this.phone = phone;
	}

	public int getCid() {
		return this.cid;
	}

	public void setCid(int cid) {
		this.cid = cid;
	}

	public String getPassword() {
		return this.password;
	}

	public void setPassword(String password) {
		this.password = password;
	}

	public String getName() {
		return this.name;
	}

	public void setName(String name) {
		this.name = name;
	}

	public String getAddress() {
		return this.address;
	}

	public void setAddress(String address) {
		this.address = address;
	}

	public String getPhone() {
		return this.phone;
	}

	public void setPhone(String phone) {
		this.phone = phone;
	}
}