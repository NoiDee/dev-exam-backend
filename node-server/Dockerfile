# Use node JS LTS version
FROM node:14-alpine

# Create application directory
WORKDIR /home/node-server

# Install app dependencies
COPY package*.json ./

# Make a clean npm install and only install modules
# needed for production
RUN npm ci --only=production

# Bundle app source
COPY . .

# Exposes the port "3000" from the container
EXPOSE 3000

# Run the node application
CMD ["npm", "run", "prod"]

# Change user to node
USER node