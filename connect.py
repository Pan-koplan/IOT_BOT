import requests

def send_get_request(url, params=None, headers=None):
    response = requests.get(url, params=params, headers=headers)
    return response.json() if response.headers.get("Content-Type") == "application/json" else response.text

def send_post_request(url, data=None, json=None, headers=None):
    response = requests.post(url, data=data, json=json, headers=headers)
    return response.json() if response.headers.get("Content-Type") == "application/json" else response.text

def send_put_request(url, data=None, json=None, headers=None):
    response = requests.put(url, data=data, json=json, headers=headers)
    return response.json() if response.headers.get("Content-Type") == "application/json" else response.text

def send_delete_request(url, headers=None):
    response = requests.delete(url, headers=headers)
    return response.json() if response.headers.get("Content-Type") == "application/json" else response.text

# Пример использования
if __name__ == "__main__":
    url = "http://158.160.15.198/hi"
    response = send_get_request(url)
    print(response)
