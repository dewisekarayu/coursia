FROM node:20-alpine
WORKDIR /app

# Copy package.json from the lumiox-9router folder
COPY lumiox-9router/package*.json ./

# Install dependencies
RUN npm install

# Copy the rest of the lumiox-9router files
COPY lumiox-9router/ ./

# Expose port and start
EXPOSE 7860
ENV PORT=7860
CMD ["npm", "start"]
