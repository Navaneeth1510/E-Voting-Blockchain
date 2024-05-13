import datetime
import hashlib
import json
from flask import Flask, jsonify, request
import os

print("Current working directory:", os.getcwd())  # Debugging current working directory


# Building the Blockchain
class Blockchain:
    def __init__(self, data_file='trial_blockchain.json'):
        self.chain = []
        self.data_file = data_file
        if os.path.exists(data_file):
            self.load_chain()  # Load existing blockchain
        else:
            # If the file doesn't exist, create it and initialize with a genesis block
            self.create_block(proof=1, previous_hash='0')  # Create the genesis block
            self.save_chain()  # Save the new blockchain
    
    def save_chain(self):
        # Ensure the directory for the data file exists
        file_path = os.path.abspath(self.data_file)  # Get the absolute path
        dir_path = os.path.dirname(file_path)  # Get the directory path
        
        # Create the directory if it doesn't exist
        if not os.path.exists(dir_path):
            os.makedirs(dir_path)  # Create the directory
        
        # Now, save the blockchain to the specified file
        with open(self.data_file, 'w') as f:
            json.dump(self.chain, f, indent=4)  # Write the blockchain to the file


    def load_chain(self):
        # Load the blockchain from the specified file
        with open(self.data_file, 'r') as f:
            self.chain = json.load(f)  # Load the blockchain from file
    
    def create_block(self, proof, previous_hash):
        # Create a new block
        block = {
            'index': len(self.chain) + 1,
            'timestamp': str(datetime.datetime.now()),
            'proof': proof,
            'previous_hash': previous_hash,
        }
        self.chain.append(block)
        self.save_chain()  # Save the blockchain after adding a block
        return block
    
    def get_previous_block(self):
        # Get the last block in the chain
        return self.chain[-1]

    def proof_of_work(self, previous_proof):
        new_proof = 1
        check_proof = False
        while not check_proof:
            hash_operation = hashlib.sha256(
                str(new_proof**2 - previous_proof**2).encode()
            ).hexdigest()
            if hash_operation[:4] == '0000':  # Check for leading zeroes
                check_proof = True
            else:
                new_proof += 1
        return new_proof
    
    def hash(self, block):
        # Return the SHA-256 hash of the block
        encoded_block = json.dumps(block, sort_keys=True).encode()
        return hashlib.sha256(encoded_block).hexdigest()
        
    def is_chain_valid(self, chain):
        # Validate the blockchain
        previous_block = chain[0]
        block_index = 1
        while block_index < len(chain):
            block = chain[block_index]
            if block['previous_hash'] != self.hash(previous_block):
                return False  # Check if previous hash matches
            previous_proof = previous_block['proof']
            proof = block['proof']
            hash_operation = hashlib.sha256(
                str(proof**2 - previous_proof**2).encode()
            ).hexdigest()
            if hash_operation[:4] != '0000':  # Check proof-of-work
                return False
            previous_block = block
            block_index += 1
        return True
    
    def tamper_block_data(self, block_index, new_data):
        if 0 < block_index < len(self.chain):
            block = self.chain[block_index]
            block['block_data'] = new_data
            self.save_chain() 
            return block
        else:
            raise ValueError("Invalid block index")
        
    def restore_blockchain_from_backup(self, backup_file='backup_blockchain.json'):
        if os.path.exists(backup_file):
            with open(backup_file, 'r') as backup:
                self.chain = json.load(backup) 
            self.save_chain() 
            return True
        else:
            raise FileNotFoundError("Backup file not found")




# Create a Flask WebApp
app = Flask(__name__)
app.config['JSONIFY_PRETTYPRINT_REGULAR'] = False

blockchain = Blockchain()  # Instance of the Blockchain class

# Mining a New Block
@app.route('/mine_block', methods=['POST'])
def mine_block():
    data = request.get_json()     
    if not data or 'candidate_id' not in data or 'timestamp' not in data:
        return jsonify({'message': 'Invalid data: Missing candidate_id or timestamp'}), 400
    
    candidate_id = data['candidate_id']
    timestamp = data['timestamp']

    previous_block = blockchain.get_previous_block()
    previous_proof = previous_block['proof']
    
    proof = blockchain.proof_of_work(previous_proof)  # Proof-of-work
    previous_hash = blockchain.hash(previous_block)  # Hash of previous block
    
    block = blockchain.create_block(proof, previous_hash)  # Create a new block
 
    block['block_data'] = {
        'candidate_id': candidate_id,
        'timestamp': timestamp,
    }

    blockchain.save_chain()
    
    response = {
        'message': 'Congratulations, you just mined a block!',
        'index': block['index'],
        'timestamp': block['timestamp'],
        'proof': block['proof'],
        'previous_hash': block['previous_hash'],
        'block_data': block['block_data'],
    }
    return jsonify(response), 200  

#reset the blockchain once the election starts
@app.route('/reset_blockchain', methods=['POST'])  
def reset_blockchain():
    blockchain.chain = []  
    blockchain.create_block(proof=1, previous_hash='0') 
    blockchain.save_chain() 
    return jsonify({'message': 'Blockchain reset to genesis block.'}), 200  

#backup process of blockchain
@app.route('/backup_blockchain', methods=['POST'])
def backup_blockchain():
    backup_file = 'backup_blockchain.json'
    backup_dir = os.path.dirname(os.path.abspath(backup_file))  

    if not os.path.exists(backup_dir):
        os.makedirs(backup_dir)
    with open(blockchain.data_file, 'r') as original_file:
        blockchain_data = json.load(original_file)

    with open(backup_file, 'w') as backup:
        json.dump(blockchain_data, backup, indent=4)

    return jsonify({"message": "Blockchain backup successful"}), 200


# Get the Entire Blockchain
@app.route('/get_chain', methods=['GET'])
def get_chain():
    response = {
        'chain': blockchain.chain,
        'length': len(blockchain.chain),
    }
    return jsonify(response), 200


# Check if the Blockchain is Valid
@app.route('/is_valid', methods=['GET'])
def is_valid():
    is_valid = blockchain.is_chain_valid(blockchain.chain)
    response = {
        'message': 'All good. The Blockchain is valid.' if is_valid else 'Navaneeth, we have a problem. The Blockchain is invalid.',
        'is_valid': is_valid,
    }
    return jsonify(response), 200



#function to tamper the data ie modify the data in the specifies block
@app.route('/tamper_block_data', methods=['POST'])
def tamper_block_data():
    data = request.get_json()
    if 'block_index' in data and 'new_data' in data:
        block_index = data['block_index']
        new_data = data['new_data']
        try:
            blockchain.tamper_block_data(block_index, new_data)
            return jsonify({"message": f"Block {block_index} data modified. Blockchain is now invalid."}), 200
        except ValueError as e:
            return jsonify({"error": str(e)}), 400
    return jsonify({"error": "Invalid data"}), 400



#function to restore the blockcahin after invalidation
@app.route('/restore_blockchain', methods=['POST'])
def restore_blockchain():
    try:
        blockchain.restore_blockchain_from_backup()
        return jsonify({"message": "Blockchain restored from backup"}), 200
    except FileNotFoundError as e:
        return jsonify({"error": str(e)}), 404

# Run the Flask App
app.run(host='0.0.0.0', port=5005) 
